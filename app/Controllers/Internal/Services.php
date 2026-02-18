<?php

namespace App\Controllers\Internal;

use App\Controllers\BaseController;
use App\Models\LandingServiceModel;

class Services extends BaseController
{
    protected $serviceModel;

    public function __construct()
    {
        $this->serviceModel = new LandingServiceModel();
    }

    public function index()
    {
        $services = $this->serviceModel
            ->orderBy('sort_order', 'ASC')
            ->findAll();

        return view('internal/services/index', [
            'title' => 'Section Layanan',
            'services' => $services
        ]);
    }

    public function edit($id)
    {
        $service = $this->serviceModel->find($id);

        if (!$service) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        return view('internal/services/edit', [
            'title' => 'Edit Section Layanan',
            'service' => $service
        ]);
    }

    public function update($id)
    {
        $service = $this->serviceModel->find($id);

        if (!$service) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $validationRules = [
            'title' => [
                'label'  => 'Judul',
                'rules'  => 'required|min_length[5]',
            ],
            'description' => [
                'label'  => 'Deskripsi',
                'rules'  => 'required|min_length[30]',
            ],
            'icon' => [
                'label'  => 'Icon',
                'rules'  => 'required',
            ],
            'link' => [
                'label'  => 'Link',
                'rules'  => 'required',
            ],
        ];

        $validationMessages = [
            'title' => [
                'required' => 'Judul wajib diisi.',
                'min_length' => 'Judul minimal 5 karakter.',
            ],
            'description' => [
                'required' => 'Deskripsi wajib diisi.',
                'min_length' => 'Deskripsi minimal 30 karakter.',
            ],
            'icon' => [
                'required' => 'Icon wajib diisi',
            ],
            'link' => [
                'required' => 'Link wajib diisi.',
            ],
        ];

        if (!$this->validate($validationRules, $validationMessages)) {
            return redirect()->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        $data = [
            'title'       => $this->request->getPost('title'),
            'description' => $this->request->getPost('description'),
            'icon'        => $this->request->getPost('icon'),
            'link'        => $this->request->getPost('link'),
            'updated_by'  => session('user_id'),
        ];

        $this->serviceModel->update($id, $data);

        return redirect()->to('/portal-internal-x83fj9/services')
            ->with('success', 'Layanan berhasil diperbarui.');
    }
}
