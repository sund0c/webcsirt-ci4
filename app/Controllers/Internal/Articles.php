<?php

namespace App\Controllers\Internal;

use App\Controllers\BaseController;
use App\Models\ArticleModel;

class Articles extends BaseController
{
    protected $articleModel;
    protected $activityLogger;



    public function __construct()
    {
        $this->articleModel = new ArticleModel();
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
            'title' => 'Manajemen Artikel',
            'articles' => $this->articleModel
                ->orderBy('created_at', 'DESC')
                ->findAll()
        ];

        return view('internal/articles/index', $data);
    }

    // =============================
    // CREATE FORM
    // =============================
    public function create()
    {
        return view('internal/articles/create', [
            'title' => 'Tambah Artikel'
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
            ]
        ];

        $validationMessages = [
            'title' => [
                'required' => 'Judul wajib diisi.',
                'min_length' => 'Judul minimal 5 karakter.',
                'max_length' => 'Judul maksimal 255 karakter.'
            ],
            'content' => [
                'required' => 'Isi artikel wajib diisi.',
                'min_length' => 'Isi artikel  minimal 30 karakter.',
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
            ]
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
        while ($this->articleModel->where('slug', $slug)->first()) {
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

            $destination = WRITEPATH . 'uploads/articles/' . $newName;

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
        // SIMPAN ARTIKEL
        // ============================



        $this->articleModel->insert($data);
        $articleId = (int) $this->articleModel->getInsertID();


        // ============================
        // LOGGING
        // ============================

        $this->activityLogger->log(
            'ARTICLE_CREATE',
            'articles',
            $articleId,
            'Create artikel: ' . $data['title'],
            null,
            $data
        );

        return redirect()->to('/portal-internal-x83fj9/articles')
            ->with('success', 'Artikel berhasil dibuat');
    }

    // =============================
    // EDIT FORM
    // =============================
    public function edit($id)
    {
        $article = $this->articleModel->find($id);


        if (!$article) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException();
        }

        return view('internal/articles/edit', [
            'title'   => 'Edit Artikel',
            'article' => $article
        ]);
    }

    // =============================
    // UPDATE
    // =============================
    public function update($id)
    {
        $article = $this->articleModel->find($id);

        if (!$article) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException();
        }

        // ===============================
        // VALIDATION
        // ===============================
        $validationRules = [
            'title' => 'required|min_length[10]|max_length[255]',
            'content' => 'required|min_length[30]',
            'status' => 'required|in_list[DRAFT,PUBLISHED]',
            'image_caption' => 'required|min_length[10]|max_length[100]',
            'featured_image' => 'if_exist|is_image[featured_image]|mime_in[featured_image,image/jpg,image/jpeg,image/png]|ext_in[featured_image,jpg,jpeg,png]|max_size[featured_image,2048]'
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
            $destination = WRITEPATH . 'uploads/articles/' . $newName;

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

        $this->articleModel->update($id, $data);

        // Hapus file lama jika upload baru sukses
        if (!empty($data['featured_image']) && !empty($article['featured_image'])) {
            $oldPath = WRITEPATH . 'uploads/articles/' . $article['featured_image'];
            if (is_file($oldPath)) {
                unlink($oldPath);
            }
        }

        $this->activityLogger->log(
            'ARTICLE_UPDATE',
            'articles',
            $id,
            'Update artikel: ' . $title,
            $article,
            $data
        );

        $db->transComplete();

        if ($db->transStatus() === false) {
            return redirect()->back()
                ->with('error', 'Gagal memperbarui artikel.');
        }

        return redirect()->to('/portal-internal-x83fj9/articles')
            ->with('success', 'Artikel berhasil diperbarui.');
    }


    // =============================
    // DELETE (SOFT DELETE)
    // =============================
    public function delete($id)
    {
        $article = $this->articleModel->find($id);

        if (!$article) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException();
        }

        $rateKey = 'delete_article_' . session('user_id');
        $attempt = cache($rateKey) ?? 0;

        if ($attempt >= 5) {
            return redirect()->back()
                ->with('error', 'Terlalu banyak aksi delete. Tunggu 1 menit.');
        }

        cache()->save($rateKey, $attempt + 1, 60);


        $this->articleModel->delete($id);




        // log activity
        $this->activityLogger->log(
            'ARTICLE_DELETE',
            'articles',
            $id,
            'Delete artikel: ' . $article['title'],
            $article,
            null
        );

        return redirect()->to('/portal-internal-x83fj9/articles')
            ->with('success', 'Artikel berhasil dihapus');
    }

    // =============================
    // TRASH RESTORE
    // =============================

    public function trash()
    {
        $data = [
            'title' => 'Riwayat Artikel Dihapus',
            'articles' => $this->articleModel
                ->onlyDeleted()
                ->findAll()
        ];

        return view('internal/articles/trash', $data);
    }

    public function restore($id)
    {
        // Ambil data termasuk yang sudah dihapus
        $article = $this->articleModel->withDeleted()->find($id);

        if (!$article) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException();
        }

        // Pastikan memang sudah dihapus
        if ($article['deleted_at'] === null) {
            return redirect()->back()
                ->with('error', 'Artikel tidak dalam kondisi terhapus.');
        }

        $this->articleModel
            ->update($id, ['deleted_at' => null, 'status' => 'DRAFT']);

        // Logging
        $this->activityLogger->log(
            'ARTICLE_RESTORE',
            'articles',
            $id,
            'Restore artikel: ' . $article['title'],
            ['deleted_at' => $article['deleted_at']],
            ['deleted_at' => null, 'status' => 'DRAFT']
        );

        return redirect()->to('/portal-internal-x83fj9/articles/trash');
    }

    public function preview($filename)
    {
        $path = WRITEPATH . 'uploads/articles/' . $filename;

        if (!is_file($path)) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        return $this->response
            ->setHeader('Content-Type', mime_content_type($path))
            ->setBody(file_get_contents($path));
    }
}
