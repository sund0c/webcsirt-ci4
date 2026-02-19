<?php

namespace App\Controllers\Public;

use App\Controllers\BaseController;
use App\Models\SiteSettingsModel;

class Home extends BaseController
{
    public function index()
    {
        $settingsModel = new SiteSettingsModel();

        // Ambil settings utama (asumsi 1 baris / id=1) — sesuaikan dengan model kamu
        $site = $settingsModel->first();

        // Normalisasi biar aman dipakai di view
        $data = [
            'site' => $site ?? [],
            'pageTitle' => ($site['site_name'] ?? 'CSIRT') . ' - Beranda',
        ];

        return view('public/home', $data);
    }
}
