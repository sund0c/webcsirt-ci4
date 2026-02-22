<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class MediaController extends Controller
{
    public function settings($filename)
    {
        $path = WRITEPATH . 'uploads/settings/' . $filename;

        if (!is_file($path)) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        return $this->response
            ->setHeader('Content-Type', mime_content_type($path))
            ->setBody(file_get_contents($path));
    }

    public function landing($filename)
    {
        $allowed = ['png', 'jpg', 'jpeg', 'webp'];

        $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));

        if (!in_array($ext, $allowed)) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $path = WRITEPATH . 'uploads/landing/' . $filename;

        if (!is_file($path)) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        return $this->response
            ->setHeader('Content-Type', mime_content_type($path))
            ->setHeader('Cache-Control', 'public, max-age=3600')
            ->setBody(file_get_contents($path));
    }


    public function heroCss()
    {
        $landingModel = new \App\Models\LandingSectionModel();

        $hero = $landingModel
            ->where('section_key', 'hero')
            ->first();

        if (!$hero || empty($hero['background_image'])) {
            return $this->response
                ->setHeader('Content-Type', 'text/css')
                ->setBody('');
        }

        $bgUrl = base_url('media/landing/' . $hero['background_image']);

        $css = "
    .hero-bg {
        background-image: url('$bgUrl');
        background-size: cover;
        background-position: center;
    }
    ";

        return $this->response
            ->setHeader('Content-Type', 'text/css')
            ->setHeader('Cache-Control', 'public, max-age=3600')
            ->setBody($css);
    }

    public function advisory($filename)
    {
        $allowed = ['png', 'jpg', 'jpeg', 'webp'];

        $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));

        if (!in_array($ext, $allowed)) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $path = WRITEPATH . 'uploads/advisories/' . $filename;

        if (!is_file($path)) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        return $this->response
            ->setHeader('Content-Type', mime_content_type($path))
            ->setHeader('Cache-Control', 'public, max-age=3600')
            ->setBody(file_get_contents($path));
    }

    public function guide($filename)
    {
        $path = WRITEPATH . 'uploads/guides/' . $filename;

        if (!is_file($path)) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        return $this->response
            ->setHeader('Content-Type', mime_content_type($path))
            ->setHeader('Content-Disposition', 'attachment; filename="' . basename($path) . '"')
            ->setHeader('Cache-Control', 'public, max-age=3600')
            ->setBody(file_get_contents($path));
    }

    public function article($filename)
    {
        $allowed = ['png', 'jpg', 'jpeg', 'webp'];

        $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));

        if (!in_array($ext, $allowed)) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $path = WRITEPATH . 'uploads/articles/' . $filename;

        if (!is_file($path)) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        return $this->response
            ->setHeader('Content-Type', mime_content_type($path))
            ->setHeader('Cache-Control', 'public, max-age=3600')
            ->setBody(file_get_contents($path));
    }
}
