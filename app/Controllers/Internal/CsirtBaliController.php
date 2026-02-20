<?php

namespace App\Controllers\Internal;

use App\Controllers\BaseController;
use App\Models\CsirtBaliModel;

class CsirtBaliController extends BaseController
{
    protected $csirtbaliModel;
    protected $csirtbaliLogger;

    public function __construct()
    {
        $this->csirtbaliModel = new CsirtBaliModel();
        helper(['text', 'url']);
        helper('security');
        $this->csirtbaliLogger = new \App\Libraries\ActivityLogger();
    }

    public function index()
    {
        $data = [
            'title'  => 'Data CSIRT Bali',
            'items'  => $this->csirtbaliModel->orderBy('created_at', 'DESC')->findAll()
        ];

        return view('internal/csirtbalis/index', $data);
    }

    public function create()
    {
        return view('internal/csirtbalis/create', [
            'title' => 'Tambah CSIRT Bali'
        ]);
    }

    public function store()
    {
        $validationRules = [
            'title' => [
                'label'  => 'Nama',
                'rules'  => 'required',
            ],
            'site_link' => [
                'label'  => 'Website',
                'rules' => 'required|valid_url_strict[https]'
            ],
        ];

        $validationMessages = [
            'site_link' => [
                'required' => 'Website wajib diisi',
                'valid_url_strict' => 'URL harus valid HTTPS.',
            ],
            'title' => [
                'required' => 'Nama wajib diisi.',
            ],
        ];

        if (!$this->validate($validationRules, $validationMessages)) {
            return redirect()->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        $this->csirtbaliModel->save([
            'title'     => strip_tags($this->request->getPost('title')),
            'site_link' => $this->request->getPost('site_link'),
        ]);

        return redirect()->to(base_url('portal-internal-x83fj9/csirtbalis'))
            ->with('success', 'Data berhasil ditambahkan');
    }

    public function edit($id)
    {
        $data = [
            'title' => 'Edit CSIRT Bali',
            'item'  => $this->csirtbaliModel->find($id)
        ];

        return view('internal/csirtbalis/edit', $data);
    }

    public function update($id)
    {
        $validationRules = [
            'title' => [
                'label'  => 'Nama',
                'rules'  => 'required',
            ],
            'site_link' => [
                'label'  => 'Website',
                'rules' => 'required|valid_url_strict[https]'
            ],
        ];

        $validationMessages = [
            'site_link' => [
                'required' => 'Website wajib diisi',
                'valid_url_strict' => 'URL harus valid HTTPS.',
            ],
            'title' => [
                'required' => 'Nama wajib diisi.',
            ],
        ];

        if (!$this->validate($validationRules, $validationMessages)) {
            return redirect()->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        $this->csirtbaliModel->update($id, [
            'title'     => strip_tags($this->request->getPost('title')),
            'site_link' => $this->request->getPost('site_link'),
        ]);

        return redirect()->to(base_url('portal-internal-x83fj9/csirtbalis'))
            ->with('success', 'Data berhasil diperbarui');
    }

    public function delete($id)
    {
        $csirtbali = $this->csirtbaliModel->find($id);

        $rateKey = 'delete_CSIRT' . session('user_id');
        $attempt = cache($rateKey) ?? 0;

        if ($attempt >= 5) {
            return redirect()->back()
                ->with('error', 'Terlalu banyak aksi delete. Tunggu 1 menit.');
        }

        cache()->save($rateKey, $attempt + 1, 60);

        $this->csirtbaliModel->delete($id);

        // log activity
        $this->csirtbaliLogger->log(
            'CSIRT_DELETE',
            'csirtbalis',
            $id,
            'Delete CSIRT: ' . $csirtbali['title'],
            $csirtbali,
            null
        );
        return redirect()->to(base_url('portal-internal-x83fj9/csirtbalis'))
            ->with('success', 'Data berhasil dihapus');
    }

    public function trash()
    {
        $data = [
            'title' => 'Riwayat CSIRT Dihapus',
            'csirtbalis' => $this->csirtbaliModel
                ->onlyDeleted()
                ->findAll()
        ];

        return view('internal/csirtbalis/trash', $data);
    }

    public function restore($id)
    {
        $csirtbali = $this->csirtbaliModel->withDeleted()->find($id);

        if (!$csirtbali) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException();
        }

        // Pastikan memang sudah dihapus
        if ($csirtbali['deleted_at'] === null) {
            return redirect()->back()
                ->with('error', 'CSIRT tidak dalam kondisi terhapus.');
        }

        $this->csirtbaliModel
            ->update($id, ['deleted_at' => null]);

        // Logging
        $this->csirtbaliLogger->log(
            'CSIRT_RESTORE',
            'csirtbalis',
            $id,
            'Restore CSIRT: ' . $csirtbali['title'],
            ['deleted_at' => $csirtbali['deleted_at']],
            ['deleted_at' => null]
        );
        return redirect()->to('/portal-internal-x83fj9/csirtbalis/trash');
    }
}
