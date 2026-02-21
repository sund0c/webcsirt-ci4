<?php

namespace App\Controllers\Public;

use App\Controllers\BaseController;
use App\Models\AdvisoryModel;
use App\Models\SiteSettingsModel;

class AdvisoryController extends BaseController
{
    protected $advisoryModel;
    protected $settingsModel;

    public function __construct()
    {
        $this->advisoryModel = new AdvisoryModel();
        $this->settingsModel = new SiteSettingsModel();
    }

    public function index()
    {
        $site = $this->settingsModel->first();

        $advisories = $this->advisoryModel
            ->where('status', 'published')
            ->orderBy('published_at', 'DESC')
            ->paginate(10);

        return view('public/advisory/index', [
            'site'       => $site,
            'advisories' => $advisories,
            'pager'      => $this->advisoryModel->pager,
            'pageTitle'  => 'Security Advisory'
        ]);
    }

    public function show($slug)
    {
        $site = $this->settingsModel->first();

        $advisory = $this->advisoryModel
            ->where('slug', $slug)
            ->where('status', 'PUBLISHED')
            ->first();

        if (!$advisory) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        return view('public/advisory/show', [
            'site'       => $site,
            'advisory'   => $advisory,
            'pageTitle'  => $advisory['title']
        ]);
    }
}
