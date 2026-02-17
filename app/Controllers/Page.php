<?php

namespace App\Controllers;

use App\Models\PageModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class Page extends BaseController
{
    public function show($slug)
    {
        $model = new PageModel();

        $page = $model->where('slug', $slug)
            ->where('status', 'PUBLISHED')
            ->where('deleted_at', null)
            ->first();

        if (!$page) {
            throw PageNotFoundException::forPageNotFound();
        }

        return view('public/page', ['page' => $page]);
    }
}
