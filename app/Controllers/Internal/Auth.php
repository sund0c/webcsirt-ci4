<?php

namespace App\Controllers\Internal;

use App\Controllers\BaseController;
use App\Models\UserModel;

class Auth extends BaseController
{
    public function login()
    {
        return view('internal/login');
    }

    public function attempt()
    {
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        $model = new \App\Models\UserModel();
        $logModel = new \App\Models\ActivityLogModel();

        $user = $model->where('username', $username)
            ->where('deleted_at', null)
            ->first();

        if (!$user) {
            return redirect()->back()->with('error', 'Login gagal.');
        }

        // Cek apakah akun terkunci
        if ($user['locked_until'] && strtotime($user['locked_until']) > time()) {

            $logModel->insert([
                'user_id' => $user['id'],
                'action' => 'LOGIN_BLOCKED',
                'description' => 'Akun terkunci sementara',
                'ip_address' => $this->request->getIPAddress(),
            ]);

            return redirect()->back()->with('error', 'Akun terkunci sementara.');
        }

        // Password salah
        if (!password_verify($password, $user['password'])) {

            $attempts = $user['failed_attempts'] + 1;

            $updateData = ['failed_attempts' => $attempts];

            if ($attempts >= 5) {
                $updateData['locked_until'] = date('Y-m-d H:i:s', strtotime('+10 minutes'));
                $updateData['failed_attempts'] = 0;
            }

            $model->update($user['id'], $updateData);

            $logModel->insert([
                'user_id' => $user['id'],
                'action' => 'LOGIN_FAILED',
                'description' => 'Login gagal (password salah)',
                'ip_address' => $this->request->getIPAddress(),
            ]);

            return redirect()->back()->with('error', 'Login gagal.');
        }

        // Login sukses
        $model->update($user['id'], [
            'failed_attempts' => 0,
            'locked_until' => null,
            'last_login' => date('Y-m-d H:i:s')
        ]);

        session()->regenerate();

        session()->set([
            'user_id' => $user['id'],
            'username' => $user['username'],
            'role' => $user['role'],
            'isLoggedIn' => true,
        ]);

        $logModel->insert([
            'user_id' => $user['id'],
            'action' => 'LOGIN_SUCCESS',
            'description' => 'Login berhasil',
            'ip_address' => $this->request->getIPAddress(),
        ]);

        return redirect()->to('/portal-internal-x83fj9/dashboard');
    }



    public function logout()
    {
        session()->destroy();
        return redirect()->to('/');
    }
}
