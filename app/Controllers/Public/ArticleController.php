<?php

namespace App\Controllers\Public;

use App\Controllers\BaseController;
use App\Models\ArticleModel;
use App\Models\SiteSettingsModel;

class ArticleController extends BaseController
{
    protected $articleModel;
    protected $settingsModel;

    public function __construct()
    {
        $this->articleModel = new ArticleModel();
        $this->settingsModel = new SiteSettingsModel();
    }

    public function index()
    {
        $site = $this->settingsModel->first();

        $articles = $this->articleModel
            ->where('status', 'PUBLISHED')
            ->orderBy('published_at', 'DESC')
            ->paginate(10);

        return view('public/article/index', [
            'site'       => $site,
            'articles' => $articles,
            'pager'      => $this->articleModel->pager,
            'pageTitle'  => 'Artikel Keamanan'
        ]);
    }

    public function show($slug)
    {
        $site = $this->settingsModel->first();

        $article = $this->articleModel
            ->where('slug', $slug)
            ->where('status', 'PUBLISHED')
            ->first();

        if (!$article) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        return view('public/article/show', [
            'site'       => $site,
            'article'   => $article,
            'pageTitle'  => $article['title']
        ]);
    }
}
