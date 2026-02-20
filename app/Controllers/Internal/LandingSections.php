<?php

namespace App\Controllers\Internal;

use App\Controllers\BaseController;
use App\Models\LandingSectionModel;

class LandingSections extends BaseController
{
    protected $landingModel;

    public function __construct()
    {
        $this->landingModel = new LandingSectionModel();
    }

    public function index()
    {
        $sections = $this->landingModel->findAll();

        return view('internal/landing/index', [
            'title'  => 'Landing Page Section',
            'sections' => $sections
        ]);
    }

    public function edit($id)
    {
        $section = $this->landingModel->find($id);

        if (!$section) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        return view('internal/landing/edit', [
            'title'   => 'Update Section',
            'section' => $section
        ]);
    }

    public function update($id)
    {

        $validationRules = [
            'title' => [
                'label'  => 'Judul',
                'rules'  => 'required|min_length[5]',
            ],
            'subtitle' => [
                'label'  => 'Sub Judul',
                'rules'  => 'required|min_length[30]',
            ],
            'content' => [
                'label'  => 'Konten',
                'rules'  => 'required|min_length[30]',
            ],
            'button_text' => [
                'label'  => 'Text Tombol',
                'rules'  => 'required|max_length[20]',
            ],
            'button_link' => [
                'label'  => 'Link Tombol',
                'rules'  => 'required|max_length[100]',
            ],
            'background_image' => [
                'label' => 'Background Image',
                'rules' => 'if_exist'
                    . '|is_image[background_image]'
                    . '|mime_in[background_image,image/jpg,image/jpeg,image/png]'
                    . '|ext_in[background_image,jpg,jpeg,png]'
                    . '|max_size[background_image,2048]'
                    . '|min_dims[background_image,1200,500]'
                    . '|max_dims[background_image,4000,2000]',

            ],
        ];

        $validationMessages = [
            'title' => [
                'required' => 'Judul wajib diisi.',
                'min_length' => 'Judul minimal 5 karakter.',
            ],
            'subtitle' => [
                'required' => 'Sub Judul wajib diisi.',
                'min_length' => 'Deskripsi minimal 30 karakter.',
            ],
            'content' => [
                'required' => 'Konten wajib diisi',
                'min_length' => 'Judul minimal 30 karakter.',
            ],
            'button_link' => [
                'required' => 'Link Tombol wajib diisi.',
                'max_length' => 'Link tombol minimal 100 karakter.',
            ],
            'button_text' => [
                'required' => 'Text Tombol wajib diisi.',
                'max_length' => 'Text tombol minimal 20 karakter.',
            ],
            'background_image' => [
                'is_image' => 'File harus berupa gambar.',
                'mime_in' => 'Format gambar harus JPG atau PNG.',
                'ext_in' => 'Ekstensi file harus jpg, jpeg, atau png.',
                'max_size' => 'Ukuran gambar maksimal 2MB.',
                'min_dims' => 'Rasio gambar minimal 1200,500',
                'max_dims' => 'Rasio gambar maksimal 4000,2000',
            ],
        ];

        $section = $this->landingModel->find($id);

        if (!$section) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        if (!$this->validate($validationRules, $validationMessages)) {
            return redirect()->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        $data = [
            'title' => $this->request->getPost('title'),
            'subtitle' => $this->request->getPost('subtitle'),
            'content' => $this->request->getPost('content'),
            'button_text' => $this->request->getPost('button_text'),
            'button_link' => $this->request->getPost('button_link'),
            'updated_by' => session('user_id'),
        ];


        $file = $this->request->getFile('background_image');

        if ($file && $file->isValid() && !$file->hasMoved()) {

            [$width, $height] = getimagesize($file->getTempName());

            if ($width <= $height) {
                return redirect()->back()
                    ->withInput()
                    ->with('errors', [
                        'background_image' => 'Gambar harus landscape.'
                    ]);
            }

            if ($width < 800) {
                return redirect()->back()
                    ->withInput()
                    ->with('errors', [
                        'background_image' => 'Lebar minimal gambar 800px.'
                    ]);
            }

            $newName = $file->getRandomName();

            $file->move(
                WRITEPATH . 'uploads/landing',
                $newName
            );

            // Hanya set jika upload sukses
            $data['background_image'] = $newName;
        }


        $this->landingModel->update($id, $data);

        return redirect()->to('/portal-internal-x83fj9/landing')
            ->with('success', 'Section berhasil diperbarui.');
    }

    public function preview($filename)
    {
        $path = WRITEPATH . 'uploads/landing/' . $filename;

        if (!is_file($path)) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        return $this->response
            ->setHeader('Content-Type', mime_content_type($path))
            ->setBody(file_get_contents($path));
    }
}
