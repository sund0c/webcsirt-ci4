<?php

namespace App\Controllers;

use App\Models\AdvisoryModel;
use CodeIgniter\Controller;

class Sitemap extends Controller
{
    public function index()
    {
        helper('url');

        $advisoryModel = new AdvisoryModel();

        $advisories = $advisoryModel
            ->where('status', 'PUBLISHED')
            ->orderBy('published_at', 'DESC')
            ->findAll();

        $data = [
            'advisories' => $advisories
        ];

        return $this->response
            ->setHeader('Content-Type', 'text/xml')
            ->setBody(view('sitemap', $data));
    }
}
