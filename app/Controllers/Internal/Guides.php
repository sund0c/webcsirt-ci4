<?php

namespace App\Controllers\Internal;

use App\Controllers\BaseController;
use App\Models\GuideModel;

class Guides extends BaseController
{
    protected $activityLogger;
    protected $guideModel;

    public function __construct()
    {
        $this->guideModel = new GuideModel();
        helper(['text', 'url']);
        helper('security');

        $this->activityLogger = new \App\Libraries\ActivityLogger();
    }

    public function index()
    {
        $guides = $this->guideModel
            ->where('deleted_at', null)
            ->orderBy('created_at', 'DESC')
            ->findAll();

        return view('internal/guides/index', [
            'title'  => 'Guides / Panduan',
            'guides' => $guides
        ]);
    }

    public function create()
    {
        return view('internal/guides/create', [
            'title' => 'Tambah Guides / Panduan'
        ]);
    }

    public function store()
    {
        $validation = \Config\Services::validation();

        $validationRules = [
            'title' => [
                'label'  => 'Judul',
                'rules'  => 'required|min_length[5]|max_length[255]',
            ],
            'description' => [
                'label'  => 'Deskripsi',
                'rules'  => 'required|min_length[30]',
            ],
            'status' => [
                'label'  => 'Status',
                'rules'  => 'required|in_list[DRAFT,PUBLISHED]',
            ],
            'file' => [
                'label'  => 'File',
                'rules'  => 'uploaded[file]|max_size[file,10240]|ext_in[file,pdf]',
            ],
        ];

        $validationMessages = [
            'title' => [
                'required' => 'Judul wajib diisi.',
                'min_length' => 'Judul minimal 5 karakter.',
                'max_length' => 'Judul maksimal 255 karakter.'
            ],
            'description' => [
                'required' => 'Deskripsi wajib diisi.',
                'min_length' => 'Deskripsi minimal 30 karakter.',
            ],
            'file' => [
                'uploaded' => 'File PDF wajib diunggah.',
                'ext_in' => 'Ekstensi file harus PDF.',
                'max_size' => 'Ukuran gambar maksimal 10MB.'
            ],
        ];

        if (!$this->validate($validationRules, $validationMessages)) {
            return redirect()->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        $file = $this->request->getFile('file');

        $storedName = $file->getRandomName();
        $uploadPath = WRITEPATH . 'uploads/guides/';

        if (!is_dir($uploadPath)) {
            mkdir($uploadPath, 0755, true);
        }

        $file->move($uploadPath, $storedName);

        $fullPath = $uploadPath . $storedName;

        $data = [
            'title'       => strip_tags($this->request->getPost('title')),
            'description' => strip_tags($this->request->getPost('description')),
            'file_name'   => $file->getClientName(),
            'stored_name' => $storedName,
            'file_hash'   => hash_file('sha256', $fullPath),
            'file_size'   => filesize($fullPath),
            'status'      => $this->request->getPost('status'),
            'created_by'  => session('user_id')
        ];

        $this->guideModel->insert($data);
        $guideId = (int) $this->guideModel->getInsertID();


        // ============================
        // LOGGING
        // ============================

        $this->activityLogger->log(
            'GUIDE_CERATE',
            'guides',
            $guideId,
            'Create GUIDE: ' . $data['title'],
            null,
            $data
        );

        return redirect()->to('/portal-internal-x83fj9/guides')
            ->with('success', 'Panduan berhasil ditambahkan.');
    }


    // =============================
    // EDIT FORM
    // =============================
    public function edit($id)
    {
        $guide = $this->guideModel->find($id);


        if (!$guide) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException();
        }

        return view('internal/guides/edit', [
            'title'   => 'Edit Guide / Panduan',
            'guide' => $guide
        ]);
    }

    // =============================
    // UPDATE
    // =============================
    public function update($id)
    {
        $guide = $this->guideModel->find($id);

        if (!$guide) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException();
        }

        // ===============================
        // VALIDATION
        // ===============================

        $validationRules = [
            'title' => [
                'label'  => 'Judul',
                'rules'  => 'required|min_length[5]|max_length[255]',
            ],
            'description' => [
                'label'  => 'Deskripsi',
                'rules'  => 'required|min_length[30]',
            ],
            'status' => [
                'label'  => 'Status',
                'rules'  => 'required|in_list[DRAFT,PUBLISHED]',
            ],
            'file' => [
                'label'  => 'File',
                'rules'  => 'if_exist|max_size[file,10240]|ext_in[file,pdf]',
            ],
        ];

        $validationMessages = [
            'title' => [
                'required' => 'Judul wajib diisi.',
                'min_length' => 'Judul minimal 5 karakter.',
                'max_length' => 'Judul maksimal 255 karakter.'
            ],
            'description' => [
                'required' => 'Deskripsi wajib diisi.',
                'min_length' => 'Deskripsi minimal 30 karakter.',
            ],
            'file' => [
                'ext_in' => 'Ekstensi file harus PDF.',
                'max_size' => 'Ukuran gambar maksimal 10MB.'
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
            'status'      => $this->request->getPost('status'),
            'updated_by'  => session('user_id')
        ];

        $file = $this->request->getFile('file');

        // =====================
        // JIKA ADA FILE BARU
        // =====================
        if ($file && $file->isValid() && !$file->hasMoved()) {

            $uploadPath = WRITEPATH . 'uploads/guides/';

            if (!is_dir($uploadPath)) {
                mkdir($uploadPath, 0755, true);
            }

            // Simpan info SEBELUM move
            $originalName = $file->getClientName();
            $mimeType     = $file->getClientMimeType();
            $newName      = $file->getRandomName();

            // Hapus file lama
            $oldFilePath = $uploadPath . $guide['stored_name'];
            if (file_exists($oldFilePath)) {
                unlink($oldFilePath);
            }

            // Move file
            $file->move($uploadPath, $newName);

            $fullPath = $uploadPath . $newName;

            // Update data
            $data['file_name']   = $originalName;
            $data['stored_name'] = $newName;
            $data['file_size']   = filesize($fullPath);
            // $data['file_mime']   = $mimeType;
            $data['file_hash']   = hash_file('sha256', $fullPath);
        }


        // =====================
        // UPDATE DB
        // =====================
        $this->guideModel->update($id, $data);

        // =====================
        // LOGGING
        // =====================
        $this->activityLogger->log(
            'GUIDE_UPDATE',
            'guides',
            $id,
            'Update GUIDE: ' . $guide['title'],
            $guide,
            $data
        );
        return redirect()->to('/portal-internal-x83fj9/guides')
            ->with('success', 'Guide berhasil diperbarui.');
    }
    // =============================
    // DELETE (SOFT DELETE)
    // =============================
    public function delete($id)
    {
        $guide = $this->guideModel->find($id);

        if (!$guide) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException();
        }

        $rateKey = 'delete_GUIDE_' . session('user_id');
        $attempt = cache($rateKey) ?? 0;

        if ($attempt >= 5) {
            return redirect()->back()
                ->with('error', 'Terlalu banyak aksi delete. Tunggu 1 menit.');
        }

        cache()->save($rateKey, $attempt + 1, 60);


        $this->guideModel->delete($id);




        // log activity
        $this->activityLogger->log(
            'GUIDE_DELETE',
            'guides',
            $id,
            'Delete GUIDES: ' . $guide['title'],
            $guide,
            null
        );

        return redirect()->to('/portal-internal-x83fj9/guides')
            ->with('success', 'GUIDES berhasil dihapus');
    }

    // =============================
    // TRASH RESTORE
    // =============================

    public function trash()
    {
        $data = [
            'title' => 'Riwayat GUIDES Dihapus',
            'guides' => $this->guideModel
                ->onlyDeleted()
                ->findAll()
        ];

        return view('internal/guides/trash', $data);
    }

    public function restore($id)
    {
        // Ambil data termasuk yang sudah dihapus
        $guide = $this->guideModel->withDeleted()->find($id);

        if (!$guide) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException();
        }

        // Pastikan memang sudah dihapus
        if ($guide['deleted_at'] === null) {
            return redirect()->back()
                ->with('error', 'GUIDES tidak dalam kondisi terhapus.');
        }

        $this->guideModel
            ->update($id, ['deleted_at' => null, 'status' => 'DRAFT']);

        // Logging
        $this->activityLogger->log(
            'GUIDE_RESTORE',
            'guides',
            $id,
            'Restore GUIDES: ' . $guide['title'],
            ['deleted_at' => $guide['deleted_at']],
            ['deleted_at' => null, 'status' => 'DRAFT']
        );

        return redirect()->to('/portal-internal-x83fj9/guides/trash');
    }


    // =============================
    // PREVIEW
    // =============================
    public function preview($id)
    {
        $guide = $this->guideModel
            ->where('id', $id)
            ->where('deleted_at', null)
            ->first();

        if (!$guide) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $path = WRITEPATH . 'uploads/guides/' . $guide['stored_name'];

        if (!file_exists($path)) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        // return $this->response
        //     ->download($path, null)
        //     ->setFileName($guide['file_name']);
        return $this->response
            ->setHeader('Content-Type', 'application/pdf')
            ->setHeader('Content-Disposition', 'inline; filename="' . $guide['file_name'] . '"')
            ->setHeader('Content-Length', filesize($path))
            ->setBody(file_get_contents($path));
    }
}
