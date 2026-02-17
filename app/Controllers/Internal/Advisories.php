<?php

namespace App\Controllers\Internal;

use App\Controllers\BaseController;
use App\Models\AdvisoryModel;

class Advisories extends BaseController
{
    protected $advisoryModel;
    protected $advisoryLogger;



    public function __construct()
    {
        $this->advisoryModel = new AdvisoryModel();
        helper(['text', 'url']);
        helper('security');

        $this->advisoryLogger = new \App\Libraries\ActivityLogger();
    }

    // =============================
    // LIST
    // =============================
    public function index()
    {
        $data = [
            'title' => 'Manajemen Advisory / Peringatan',
            'advisories' => $this->advisoryModel
                ->orderBy('created_at', 'DESC')
                ->findAll()
        ];

        return view('internal/advisories/index', $data);
    }

    // =============================
    // CREATE FORM
    // =============================
    public function create()
    {
        return view('internal/advisories/create', [
            'title' => 'Tambah Advisory / Peringatan'
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
                'rules'  => 'required|min_length[10]|max_length[255]',
            ],
            'content' => [
                'label'  => 'Konten',
                'rules'  => 'required|min_length[30]',
            ],
            'status' => [
                'label'  => 'Status',
                'rules'  => 'required|in_list[DRAFT,PUBLISHED]',
            ],
            'image_caption' => [
                'label' => 'Caption Gambar',
                'rules' => 'required|min_length[10]|max_length[100]'
            ],
            'featured_image' => [
                'label' => 'Featured Image',
                'rules' => 'uploaded[featured_image]'
                    . '|uploaded[featured_image]'
                    . '|is_image[featured_image]'
                    . '|mime_in[featured_image,image/jpg,image/jpeg,image/png]'
                    . '|ext_in[featured_image,jpg,jpeg,png]'
                    . '|max_size[featured_image,2048]',
            ],
            'source_url' => [
                'label' => 'Sumber Advisory',
                'rules' => 'required|valid_url_strict[https]'
            ],
        ];

        $validationMessages = [
            'source_url' => [
                'required' => 'Sumber wajib diisi.',
                'valid_url_strict' => 'URL harus valid HTTPS.',
            ],
            'title' => [
                'required' => 'Judul wajib diisi.',
                'min_length' => 'Judul minimal 5 karakter.',
                'max_length' => 'Judul maksimal 255 karakter.'
            ],
            'content' => [
                'required' => 'Isi ADVISORY wajib diisi.',
                'min_length' => 'Isi ADVISORY  minimal 30 karakter.',
            ],
            'image_caption' => [
                'required' => 'Caption foto wajib diisi.',
                'min_length' => 'Caption foto  minimal 10 karakter.',
                'max_length' => 'Caption foto  maksimal 100 karakter.'
            ],

            'featured_image' => [
                'uploaded' => 'Gambar wajib diunggah.',
                'is_image' => 'File harus berupa gambar.',
                'mime_in' => 'Format gambar harus JPG atau PNG.',
                'ext_in' => 'Ekstensi file harus jpg, jpeg, atau png.',
                'max_size' => 'Ukuran gambar maksimal 2MB.'
            ],

        ];

        if (!$this->validate($validationRules, $validationMessages)) {
            return redirect()->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }


        $title = $this->request->getPost('title');

        $slug = url_title($title, '-', true);



        $excerptInput = $this->request->getPost('excerpt');
        $excerpt = trim((string) $excerptInput);

        if ($excerpt === '') {
            $excerpt = word_limiter(
                strip_tags((string) $this->request->getPost('content')),
                30
            );
        }



        $originalSlug = $slug;
        $counter = 1;
        while ($this->advisoryModel->where('slug', $slug)->first()) {
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
            'source_url'  => $this->request->getPost('source_url'),
            'image_caption'  => strip_tags($this->request->getPost('image_caption')),
            'excerpt' => $excerpt,
            'status'       => $status,
            'published_at' => $publishedAt,
            'created_by'   => session('user_id'),
            'updated_by'   => session('user_id'),
        ];

        $file = $this->request->getFile('featured_image');

        if ($file && $file->isValid() && !$file->hasMoved()) {

            // Validasi signature gambar
            $imageInfo = getimagesize($file->getTempName());

            if (!$imageInfo) {
                return redirect()->back()
                    ->withInput()
                    ->with('errors', ['featured_image' => 'File bukan gambar valid.']);
            }

            $mime = $imageInfo['mime'];

            // Hanya izinkan JPEG & PNG
            if (!in_array($mime, ['image/jpeg', 'image/png'])) {
                return redirect()->back()
                    ->withInput()
                    ->with('errors', ['featured_image' => 'Hanya JPG dan PNG yang diizinkan.']);
            }

            $newName = bin2hex(random_bytes(16)) . '.jpg'; // paksa jadi jpg

            $destination = WRITEPATH . 'uploads/advisories/' . $newName;

            // Re-encode image untuk hapus EXIF & payload tersembunyi
            $image = imagecreatefromstring(file_get_contents($file->getTempName()));

            if (!$image) {
                return redirect()->back()
                    ->withInput()
                    ->with('errors', ['featured_image' => 'Gagal memproses gambar.']);
            }

            imagejpeg($image, $destination, 90);
            imagedestroy($image);

            // Simpan nama file ke database
            $data['featured_image'] = $newName;

            // Optional: simpan hash integrity
            $data['file_hash'] = hash_file('sha256', $destination);
        }


        // ============================
        // SIMPAN ADVISORY
        // ============================



        $this->advisoryModel->insert($data);
        $articleId = (int) $this->advisoryModel->getInsertID();


        // ============================
        // LOGGING
        // ============================

        $this->advisoryLogger->log(
            'ADVISORY_CREATE',
            'advisories',
            $articleId,
            'Create ADVISORY: ' . $data['title'],
            null,
            $data
        );

        return redirect()->to('/portal-internal-x83fj9/advisories')
            ->with('success', 'ADVISORY berhasil dibuat');
    }

    // =============================
    // EDIT FORM
    // =============================
    public function edit($id)
    {
        $advisory = $this->advisoryModel->find($id);


        if (!$advisory) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException();
        }

        return view('internal/advisories/edit', [
            'title'   => 'Edit Advisory / Peringatan',
            'advisory' => $advisory
        ]);
    }

    // =============================
    // UPDATE
    // =============================
    public function update($id)
    {
        $article = $this->advisoryModel->find($id);

        if (!$article) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException();
        }

        // ===============================
        // VALIDATION
        // ===============================

        $validationRules = [
            'title' => [
                'label'  => 'Judul',
                'rules'  => 'required|min_length[10]|max_length[255]',
            ],
            'content' => [
                'label'  => 'Konten',
                'rules'  => 'required|min_length[30]',
            ],
            'status' => [
                'label'  => 'Status',
                'rules'  => 'required|in_list[DRAFT,PUBLISHED]',
            ],
            'image_caption' => [
                'label' => 'Caption Gambar',
                'rules' => 'required|min_length[10]|max_length[100]'
            ],
            'featured_image' => [
                'label' => 'Featured Image',
                'rules' => 'if_exist'
                    . '|uploaded[featured_image]'
                    . '|is_image[featured_image]'
                    . '|mime_in[featured_image,image/jpg,image/jpeg,image/png]'
                    . '|ext_in[featured_image,jpg,jpeg,png]'
                    . '|max_size[featured_image,2048]',
            ],
            'source_url' => [
                'label' => 'Sumber Advisory',
                'rules' => 'required|valid_url_strict[https]'
            ],
        ];

        $validationMessages = [
            'source_url' => [
                'required' => 'Sumber wajib diisi.',
                'valid_url_strict' => 'URL harus valid HTTPS.',
            ],
            'title' => [
                'required' => 'Judul wajib diisi.',
                'min_length' => 'Judul minimal 5 karakter.',
                'max_length' => 'Judul maksimal 255 karakter.'
            ],
            'content' => [
                'required' => 'Isi ADVISORY wajib diisi.',
                'min_length' => 'Isi ADVISORY  minimal 30 karakter.',
            ],
            'image_caption' => [
                'required' => 'Caption foto wajib diisi.',
                'min_length' => 'Caption foto  minimal 10 karakter.',
                'max_length' => 'Caption foto  maksimal 100 karakter.'
            ],

            'featured_image' => [
                'uploaded' => 'Gambar wajib diunggah.',
                'is_image' => 'File harus berupa gambar.',
                'mime_in' => 'Format gambar harus JPG atau PNG.',
                'ext_in' => 'Ekstensi file harus jpg, jpeg, atau png.',
                'max_size' => 'Ukuran gambar maksimal 2MB.'
            ],

        ];

        if (!$this->validate($validationRules)) {
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

        $excerptInput = trim((string) $this->request->getPost('excerpt'));
        $excerpt = $excerptInput !== ''
            ? strip_tags($excerptInput)
            : word_limiter(strip_tags($content), 30);

        $status = $this->request->getPost('status');

        // Jangan reset published_at kalau sudah pernah publish
        $publishedAt = $article['published_at'];
        if ($status === 'PUBLISHED' && empty($article['published_at'])) {
            $publishedAt = date('Y-m-d H:i:s');
        }

        $data = [
            'title'         => $title,
            'body'          => $content,
            'excerpt'       => $excerpt,
            'status'        => $status,
            'source_url'  => $this->request->getPost('source_url'),
            'published_at'  => $publishedAt,
            'image_caption' => strip_tags($this->request->getPost('image_caption')),
            'updated_by'    => session('user_id'),
        ];

        // ===============================
        // HANDLE IMAGE (OPTIONAL)
        // ===============================
        $file = $this->request->getFile('featured_image');

        if ($file && $file->isValid() && !$file->hasMoved()) {

            $imageInfo = getimagesize($file->getTempName());
            if (!$imageInfo) {
                return redirect()->back()
                    ->withInput()
                    ->with('errors', ['featured_image' => 'File bukan gambar valid.']);
            }

            if (!in_array($imageInfo['mime'], ['image/jpeg', 'image/png'])) {
                return redirect()->back()
                    ->withInput()
                    ->with('errors', ['featured_image' => 'Hanya JPG dan PNG yang diizinkan.']);
            }

            // Batasi resolusi (anti bomb image)
            if ($imageInfo[0] > 4000 || $imageInfo[1] > 4000) {
                return redirect()->back()
                    ->withInput()
                    ->with('errors', ['featured_image' => 'Resolusi gambar terlalu besar.']);
            }

            $newName = bin2hex(random_bytes(16)) . '.jpg';
            $destination = WRITEPATH . 'uploads/advisories/' . $newName;

            $image = imagecreatefromstring(file_get_contents($file->getTempName()));
            if (!$image) {
                return redirect()->back()
                    ->withInput()
                    ->with('errors', ['featured_image' => 'Gagal memproses gambar.']);
            }

            imagejpeg($image, $destination, 90);
            imagedestroy($image);

            $data['featured_image'] = $newName;
            $data['file_hash'] = hash_file('sha256', $destination);
        }

        // ===============================
        // DATABASE TRANSACTION
        // ===============================
        $db = \Config\Database::connect();
        $db->transStart();

        $this->advisoryModel->update($id, $data);

        // Hapus file lama jika upload baru sukses
        if (!empty($data['featured_image']) && !empty($article['featured_image'])) {
            $oldPath = WRITEPATH . 'uploads/advisories/' . $article['featured_image'];
            if (is_file($oldPath)) {
                unlink($oldPath);
            }
        }

        $this->advisoryLogger->log(
            'ADVISORY_UPDATE',
            'advisories',
            $id,
            'Update ADVISORY: ' . $title,
            $article,
            $data
        );

        $db->transComplete();

        if ($db->transStatus() === false) {
            return redirect()->back()
                ->with('error', 'Gagal memperbarui ADVISORY.');
        }

        return redirect()->to('/portal-internal-x83fj9/advisories')
            ->with('success', 'ADVISORY berhasil diperbarui.');
    }


    // =============================
    // DELETE (SOFT DELETE)
    // =============================
    public function delete($id)
    {
        $article = $this->advisoryModel->find($id);

        if (!$article) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException();
        }

        $rateKey = 'delete_ADVISORY_' . session('user_id');
        $attempt = cache($rateKey) ?? 0;

        if ($attempt >= 5) {
            return redirect()->back()
                ->with('error', 'Terlalu banyak aksi delete. Tunggu 1 menit.');
        }

        cache()->save($rateKey, $attempt + 1, 60);


        $this->advisoryModel->delete($id);




        // log activity
        $this->advisoryLogger->log(
            'ADVISORY_DELETE',
            'advisories',
            $id,
            'Delete ADVISORY: ' . $article['title'],
            $article,
            null
        );

        return redirect()->to('/portal-internal-x83fj9/advisories')
            ->with('success', 'ADVISORY berhasil dihapus');
    }

    // =============================
    // TRASH RESTORE
    // =============================

    public function trash()
    {
        $data = [
            'title' => 'Riwayat ADVISORY Dihapus',
            'advisories' => $this->advisoryModel
                ->onlyDeleted()
                ->findAll()
        ];

        return view('internal/advisories/trash', $data);
    }

    public function restore($id)
    {
        // Ambil data termasuk yang sudah dihapus
        $article = $this->advisoryModel->withDeleted()->find($id);

        if (!$article) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException();
        }

        // Pastikan memang sudah dihapus
        if ($article['deleted_at'] === null) {
            return redirect()->back()
                ->with('error', 'ADVISORY tidak dalam kondisi terhapus.');
        }

        $this->advisoryModel
            ->update($id, ['deleted_at' => null, 'status' => 'DRAFT']);

        // Logging
        $this->advisoryLogger->log(
            'ADVISORY_RESTORE',
            'advisories',
            $id,
            'Restore ADVISORY: ' . $article['title'],
            ['deleted_at' => $article['deleted_at']],
            ['deleted_at' => null, 'status' => 'DRAFT']
        );

        return redirect()->to('/portal-internal-x83fj9/advisories/trash');
    }

    public function image($filename)
    {
        $path = WRITEPATH . 'uploads/advisories/' . $filename;

        if (!is_file($path)) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        return $this->response
            ->setHeader('Content-Type', mime_content_type($path))
            ->setBody(file_get_contents($path));
    }
}
