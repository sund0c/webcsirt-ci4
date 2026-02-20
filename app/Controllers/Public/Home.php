<?php

namespace App\Controllers\Public;

use App\Controllers\BaseController;
use App\Models\SiteSettingsModel;
use App\Models\LandingSectionModel;
use App\Models\LandingServiceModel;
use App\Models\AdvisoryModel;
use App\Models\ArticleModel;
use App\Models\CsirtBaliModel;

class Home extends BaseController
{
    public function index()
    {
        $settingsModel = new SiteSettingsModel();
        $articleModel  = new ArticleModel();
        $landingModel  = new LandingSectionModel();
        $serviceModel  = new LandingServiceModel();
        $advisoryModel = new AdvisoryModel();
        $csirtbaliModel = new CsirtBaliModel();

        // Ambil site settings
        $site = $settingsModel->first();

        $landingSections = $landingModel
            ->findAll();
        $sections = [];

        foreach ($landingSections as $section) {
            $sections[$section['section_key']] = $section;
        }

        $services = $serviceModel
            ->findAll();

        $advisories = $advisoryModel
            ->where('status', 'PUBLISHED')
            ->orderBy('published_at', 'DESC')
            ->limit(3)
            ->findAll();

        $csirtbalis = $csirtbaliModel
            ->orderBy('id', 'ASC')
            ->findAll();

        // Ambil artikel terbaru
        $articles = $articleModel
            ->where('status', 'published')
            ->orderBy('published_at', 'DESC')
            ->limit(6)
            ->findAll();

        $data = [
            'site'      => $site ?? [],
            'articles'  => $articles ?? [],
            'sections'  => $sections ?? [],
            'services'  => $services ?? [],
            'advisories' => $advisories ?? [],
            'csirtbalis' => $csirtbalis ?? [],
            'pageTitle' => ($site['site_name'] ?? 'CSIRT') . ' - Beranda',
        ];

        return view('public/home', $data);
    }
}
