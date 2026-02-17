<?php

namespace App\Controllers;

use App\Models\ArticleModel;

class Advisory extends BaseController
{
    public function index()
    {
        $model = new ArticleModel();

        $data = [
            'title'    => 'Advisory Keamanan',
            'articles' => $model
                ->where('status', 'PUBLISHED')
                ->where('deleted_at', null)
                ->orderBy('published_at', 'DESC')
                ->paginate(6),
            'pager'    => $model->pager
        ];

        return view('public/advisory_index', $data);
    }
}
