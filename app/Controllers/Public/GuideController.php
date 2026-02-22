<?php

namespace App\Controllers\Public;

use App\Controllers\BaseController;
use App\Models\GuideModel;
use App\Models\SiteSettingsModel;

class GuideController extends BaseController
{
    protected $guideModel;
    protected $settingsModel;

    public function __construct()
    {
        $this->guideModel   = new GuideModel();
        $this->settingsModel = new SiteSettingsModel();
    }

    public function index()
    {
        $site = $this->settingsModel->first();

        $guides = $this->guideModel
            ->where('status', 'PUBLISHED')
            ->where('deleted_at', null)
            ->orderBy('published_at', 'DESC')
            ->findAll();

        return view('public/guide', [
            'site'      => $site,
            'guides'    => $guides,
            'pageTitle' => 'Panduan Teknis'
        ]);
    }
}
