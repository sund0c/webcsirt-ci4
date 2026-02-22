<?php

namespace App\Controllers\Internal;

use App\Controllers\BaseController;
use App\Models\PageModel;
use App\Models\ActivityLogModel;

class Pages extends BaseController
{
    protected $pageModel;
    protected $activityLogger;



    public function __construct()
    {
        $this->pageModel = new PageModel();
        helper(['text', 'url']);
        helper('security');

        $this->activityLogger = new \App\Libraries\ActivityLogger();
    }

    // =============================
    // LIST
    // =============================
    public function index()
    {
        $data = [
            'title' => 'Manajemen Page',
            'pages' => $this->pageModel
                ->orderBy('created_at', 'DESC')
                ->findAll()
        ];

        return view('internal/pages/index', $data);
    }

    // =============================
    // CREATE FORM
    // =============================
    public function create()
    {
        return view('internal/pages/create', [
            'title' => 'Tambah Page'
        ]);
    }

    // =============================
    // STORE
    // =============================
    public function store()
    {
        $validationRules = [
            'title' => [
                'label'  => 'Judul',
                'rules'  => 'required|min_length[5]|max_length[255]',
            ],
            'content' => [
                'label'  => 'Konten',
                'rules'  => 'required|min_length[30]',
            ],
            'status' => [
                'label'  => 'Status',
                'rules'  => 'required|in_list[DRAFT,PUBLISHED]',
            ],
        ];

        $validationMessages = [
            'title' => [
                'required' => 'Judul wajib diisi.',
                'min_length' => 'Judul minimal 5 karakter.',
                'max_length' => 'Judul maksimal 255 karakter.'
            ],
            'content' => [
                'required' => 'Isi page wajib diisi.',
                'min_length' => 'Isi page  minimal 30 karakter.',
            ],
        ];

        if (!$this->validate($validationRules, $validationMessages)) {
            return redirect()->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }


        $title = $this->request->getPost('title');

        $slug = url_title($title, '-', true);

        $originalSlug = $slug;
        $counter = 1;
        while ($this->pageModel->where('slug', $slug)->first()) {
            $slug = $originalSlug . '-' . $counter++;
        }

        $status = $this->request->getPost('status');

        $publishedAt = null;
        if ($status === 'PUBLISHED') {
            $publishedAt = date('Y-m-d H:i:s');
        }

        $data = [
            'slug'         => $slug,
            'title'        => strip_tags($title),
            'body'         => clean_html($this->request->getPost('content')),
            'status'       => $status,
            'published_at' => $publishedAt,
            'created_by'   => session('user_id'),
            'updated_by'   => session('user_id'),
        ];


        // ============================
        // SIMPAN ARTIKEL
        // ============================

        $this->pageModel->insert($data);
        $pageId = (int) $this->pageModel->getInsertID();


        // ============================
        // LOGGING
        // ============================

        $this->activityLogger->log(
            'PAGE_CREATE',
            'pages',
            $pageId,
            'Create page: ' . $data['title'],
            null,
            $data
        );

        return redirect()->to('/portal-internal-x83fj9/pages')
            ->with('success', 'Page berhasil dibuat');
    }

    // =============================
    // EDIT FORM
    // =============================
    public function edit($id)
    {
        $page = $this->pageModel->find($id);


        if (!$page) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException();
        }

        return view('internal/pages/edit', [
            'title'   => 'Edit Page',
            'page' => $page
        ]);
    }

    // =============================
    // UPDATE
    // =============================
    public function update($id)
    {
        $page = $this->pageModel->find($id);

        if (!$page) {
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
            'content' => [
                'label'  => 'Konten',
                'rules'  => 'required|min_length[30]',
            ],
            'status' => [
                'label'  => 'Status',
                'rules'  => 'required|in_list[DRAFT,PUBLISHED]',
            ],
        ];

        $validationMessages = [
            'title' => [
                'required' => 'Judul wajib diisi.',
                'min_length' => 'Judul minimal 5 karakter.',
                'max_length' => 'Judul maksimal 255 karakter.'
            ],
            'content' => [
                'required' => 'Isi page wajib diisi.',
                'min_length' => 'Isi page  minimal 30 karakter.',
            ],
        ];

        if (!$this->validate($validationRules, $validationMessages)) {
            return redirect()->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        // ===============================
        // PREPARE DATA
        // ===============================
        helper(['text', 'security']);

        $title   = strip_tags($this->request->getPost('title'));
        $content = clean_html($this->request->getPost('content'));


        $status = $this->request->getPost('status');

        // Jangan reset published_at kalau sudah pernah publish
        $publishedAt = $page['published_at'];
        if ($status === 'PUBLISHED' && empty($page['published_at'])) {
            $publishedAt = date('Y-m-d H:i:s');
        }

        $data = [
            'title'         => $title,
            'body'          => $content,
            'status'        => $status,
            'published_at'  => $publishedAt,
            'updated_by'    => session('user_id'),
        ];


        // ===============================
        // DATABASE TRANSACTION
        // ===============================
        $db = \Config\Database::connect();
        $db->transStart();

        $this->pageModel->update($id, $data);

        $this->activityLogger->log(
            'PAGE_UPDATE',
            'pages',
            $id,
            'Update page: ' . $title,
            $page,
            $data
        );

        $db->transComplete();

        if ($db->transStatus() === false) {
            return redirect()->back()
                ->with('error', 'Gagal memperbarui page.');
        }

        return redirect()->to('/portal-internal-x83fj9/pages')
            ->with('success', 'Page berhasil diperbarui.');
    }


    // =============================
    // DELETE (SOFT DELETE)
    // =============================
    public function delete($id)
    {
        $page = $this->pageModel->find($id);

        if (!$page) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException();
        }

        $rateKey = 'delete_PAGE_' . session('user_id');
        $attempt = cache($rateKey) ?? 0;

        if ($attempt >= 5) {
            return redirect()->back()
                ->with('error', 'Terlalu banyak aksi delete. Tunggu 1 menit.');
        }

        cache()->save($rateKey, $attempt + 1, 60);


        $this->pageModel->delete($id);




        // log activity
        $this->activityLogger->log(
            'PAGE_DELETE',
            'pages',
            $id,
            'Delete page: ' . $page['title'],
            $page,
            null
        );

        return redirect()->to('/portal-internal-x83fj9/pages')
            ->with('success', 'Page berhasil dihapus');
    }

    // =============================
    // TRASH RESTORE
    // =============================

    public function trash()
    {
        $data = [
            'title' => 'Riwayat Page Dihapus',
            'pages' => $this->pageModel
                ->onlyDeleted()
                ->findAll()
        ];

        return view('internal/pages/trash', $data);
    }

    public function restore($id)
    {
        // Ambil data termasuk yang sudah dihapus
        $page = $this->pageModel->withDeleted()->find($id);

        if (!$page) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException();
        }

        // Pastikan memang sudah dihapus
        if ($page['deleted_at'] === null) {
            return redirect()->back()
                ->with('error', 'Page tidak dalam kondisi terhapus.');
        }

        $this->pageModel
            ->update($id, ['deleted_at' => null, 'status' => 'DRAFT']);

        // Logging
        $this->activityLogger->log(
            'PAGE_RESTORE',
            'pages',
            $id,
            'Restore page: ' . $page['title'],
            ['deleted_at' => $page['deleted_at']],
            ['deleted_at' => null, 'status' => 'DRAFT']
        );

        return redirect()->to('/portal-internal-x83fj9/pages/trash');
    }

    public function uploadImage()
    {

        $file = $this->request->getFile('file');

        if (!$file || !$file->isValid()) {
            return $this->response->setJSON(['error' => 'File tidak valid']);
        }

        // Validasi mime
        $allowedMime = ['image/jpeg', 'image/png', 'image/webp'];
        if (!in_array($file->getMimeType(), $allowedMime)) {
            return $this->response->setJSON(['error' => 'Format tidak diizinkan']);
        }

        // Validasi size max 2MB
        if ($file->getSize() > 2 * 1024 * 1024) {
            return $this->response->setJSON(['error' => 'Maksimal 2MB']);
        }

        // Generate nama random
        $newName = $file->getRandomName();

        $uploadPath = FCPATH . 'uploads/pages/';

        if (!is_dir($uploadPath)) {
            mkdir($uploadPath, 0755, true);
        }

        $file->move($uploadPath, $newName);

        return $this->response->setJSON([
            'location' => base_url('uploads/pages/' . $newName)
        ]);
    }
}
