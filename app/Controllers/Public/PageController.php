<?php

namespace App\Controllers\Public;

use App\Controllers\BaseController;
use App\Models\PageModel;
use App\Models\SiteSettingsModel;
use App\Models\LandingSectionModel;

class PageController extends BaseController
{
    protected $pageModel;
    protected $settingsModel;
    protected $landingModel;

    public function __construct()
    {
        $this->pageModel     = new PageModel();
        $this->settingsModel = new SiteSettingsModel();
        $this->landingModel  = new LandingSectionModel();
    }

    public function show($slug)
    {
        $site = $this->settingsModel->first();
        $landing = $this->landingModel->findAll();

        $page = $this->pageModel
            ->where('slug', $slug)
            ->where('status', 'PUBLISHED')
            ->first();

        if (!$page) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        return view('public/page', [
            'page'      => $page,
            'site'      => $site ?? [],
            'landing'      => $landing ?? [],
            'pageTitle' => $page['title']
        ]);
    }
}
