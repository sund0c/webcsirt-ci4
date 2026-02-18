<?php

namespace App\Controllers\Internal;

use App\Controllers\BaseController;
use App\Models\SiteSettingsModel;

class SiteSettings extends BaseController
{
    protected $model;

    public function __construct()
    {
        $this->model = new SiteSettingsModel();
    }

    public function index()
    {
        $settings = $this->model->first();

        return view('internal/settings/edit', [
            'title' => 'Site Settings',
            'settings' => $settings
        ]);
    }

    public function update()
    {
        $settings = $this->model->first();
        $id = $settings['id'];

        $validationRules = [
            'site_name' => [
                'label'  => 'Nama Situs',
                'rules'  => 'required',
            ],
            'site_tagline' => [
                'label'  => 'Tagline',
                'rules'  => 'required',
            ],
            'site_email' => [
                'label'  => 'Email',
                'rules'  => 'required|valid_email',
            ],
            'site_phone' => [
                'label'  => 'Telpon',
                'rules'  => 'required|numeric',
            ],
            'site_address' => [
                'label'  => 'Alamat',
                'rules'  => 'required',
            ],
            'kanal_aduan' => [
                'label'  => 'Kanal Aduan',
                'rules' => 'required|valid_url_strict[https]'
            ],
            'logo' => [
                'label' => 'Logo',
                'rules' => 'if_exist|is_image[logo]|mime_in[logo,image/jpg,image/jpeg,image/png,image/svg+xml]|ext_in[logo,jpg,jpeg,png,svg]|max_size[logo,2048]',
            ],
            'favicon' => [
                'label' => 'Favicon',
                'rules' => 'if_exist|is_image[favicon]|mime_in[favicon,image/x-icon,image/png]|ext_in[favicon,ico,png]|max_size[favicon,1024]',
            ],
        ];

        $validationMessages = [
            'site_name' => [
                'required' => 'Nama Situs wajib diisi.',
            ],
            'site_tagline' => [
                'required' => 'Tagline wajib diisi.',
            ],
            'site_email' => [
                'required' => 'Email wajib diisi',
                'valid_email' => 'Email harus valid',
            ],
            'site_phone' => [
                'required' => 'Telpon wajib diisi.',
                'numeric' => 'Telpon hanya angka',
            ],
            'site_address' => [
                'required' => 'Alamat wajib diisi.',
            ],
            'kanal_aduan' => [
                'required' => 'Kanal Aduan wajib diisi.',
                'valid_url_strict' => 'Url harus valid HTTPS'
            ],
        ];

        if (!$this->validate($validationRules, $validationMessages)) {
            return redirect()->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }


        $data = [
            'site_name'    => strip_tags($this->request->getPost('site_name')),
            'site_tagline' => strip_tags($this->request->getPost('site_tagline')),
            'site_email'   => $this->request->getPost('site_email'),
            'site_phone'   => strip_tags($this->request->getPost('site_phone')),
            'site_address' => strip_tags($this->request->getPost('site_address')),
            'kanal_aduan'  => $this->request->getPost('kanal_aduan'),
        ];

        // Upload Logo
        $logo = $this->request->getFile('logo');
        if ($logo && $logo->isValid() && !$logo->hasMoved()) {

            if (!empty($settings['logo'])) {
                @unlink(WRITEPATH . 'uploads/settings/' . $settings['logo']);
            }

            $newName = $logo->getRandomName();
            $logo->move(WRITEPATH . 'uploads/settings', $newName);
            $data['logo'] = $newName;
        }

        // Upload Favicon
        $favicon = $this->request->getFile('favicon');
        if ($favicon && $favicon->isValid() && !$favicon->hasMoved()) {

            if (!empty($settings['favicon'])) {
                @unlink(WRITEPATH . 'uploads/settings/' . $settings['favicon']);
            }

            $newName = $favicon->getRandomName();
            $favicon->move(WRITEPATH . 'uploads/settings', $newName);
            $data['favicon'] = $newName;
        }

        $this->model->update($id, $data);

        return redirect()->back()
            ->with('success', 'Pengaturan berhasil diperbarui.');
    }

    public function preview($filename)
    {
        $path = WRITEPATH . 'uploads/settings/' . $filename;

        if (!is_file($path)) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        return $this->response
            ->setHeader('Content-Type', mime_content_type($path))
            ->setBody(file_get_contents($path));
    }
}
