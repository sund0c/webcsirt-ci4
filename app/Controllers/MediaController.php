<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class MediaController extends Controller
{
    public function settings($filename)
    {
        // $allowed = ['png', 'jpg', 'jpeg', 'webp'];

        // $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));

        // if (!in_array($ext, $allowed)) {
        //     throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        // }

        // $path = WRITEPATH . 'uploads/settings/' . $filename;

        // if (!is_file($path)) {
        //     throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        // }

        // return $this->response
        //     ->setHeader('Content-Type', mime_content_type($path))
        //     ->setBody(file_get_contents($path));
        return $this->serveFile(
            $filename,
            WRITEPATH . 'uploads/settings/',
            ['png', 'jpg', 'jpeg', 'svg', 'ico']
        );
    }

    public function landing($filename)
    {
        // $allowed = ['png', 'jpg', 'jpeg', 'webp'];

        // $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));

        // if (!in_array($ext, $allowed)) {
        //     throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        // }

        // $path = WRITEPATH . 'uploads/landing/' . $filename;

        // if (!is_file($path)) {
        //     throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        // }

        // return $this->response
        //     ->setHeader('Content-Type', mime_content_type($path))
        //     ->setHeader('Cache-Control', 'public, max-age=3600')
        //     ->setBody(file_get_contents($path));
        return $this->serveFile(
            $filename,
            WRITEPATH . 'uploads/landing/',
            ['png', 'jpg', 'jpeg', 'webp']
        );
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

        $safeName = basename($hero['background_image']);
        // Pastikan tidak kosong setelah sanitasi
        if (empty($safeName)) {
            return $this->response
                ->setHeader('Content-Type', 'text/css')
                ->setBody('');
        }
        $bgUrl = base_url('media/landing/' . $safeName);
        //$bgUrl = base_url('media/landing/' . $hero['background_image']);

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
        // $allowed = ['png', 'jpg', 'jpeg', 'webp'];

        // $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));

        // if (!in_array($ext, $allowed)) {
        //     throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        // }

        // $path = WRITEPATH . 'uploads/advisories/' . $filename;

        // if (!is_file($path)) {
        //     throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        // }

        // return $this->response
        //     ->setHeader('Content-Type', mime_content_type($path))
        //     ->setHeader('Cache-Control', 'public, max-age=3600')
        //     ->setBody(file_get_contents($path));

        return $this->serveFile(
            $filename,
            WRITEPATH . 'uploads/advisories/',
            ['png', 'jpg', 'jpeg', 'webp']
        );
    }

    public function guide($filename)
    {
        // $allowed = ['pdf'];

        // $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));

        // if (!in_array($ext, $allowed)) {
        //     throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        // }

        // $filename = basename($filename);

        // // Cek apakah file ini memang published dan tidak dihapus
        // $guideModel = new \App\Models\GuideModel();
        // $guide = $guideModel
        //     ->where('stored_name', $filename)
        //     ->where('status', 'PUBLISHED')
        //     ->where('deleted_at', null)
        //     ->first();

        // if (!$guide) {
        //     throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        // }

        // $path = WRITEPATH . 'uploads/guides/' . $filename;

        // if (!is_file($path)) {
        //     throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        // }

        // return $this->response
        //     ->setHeader('Content-Type', mime_content_type($path))
        //     ->setHeader('Content-Disposition', 'attachment; filename="' . basename($path) . '"')
        //     ->setHeader('Cache-Control', 'public, max-age=3600')
        //     ->setBody(file_get_contents($path));
        // Guide tetap butuh DB check, jadi handle terpisah
        $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
        if ($ext !== 'pdf') {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $filename = basename($filename);

        $guideModel = new \App\Models\GuideModel();
        $guide = $guideModel
            ->where('stored_name', $filename)
            ->where('status', 'PUBLISHED')
            ->where('deleted_at', null)
            ->first();

        if (!$guide) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        return $this->serveFile(
            $filename,
            WRITEPATH . 'uploads/guides/',
            ['pdf'],
            'attachment'
        );
    }

    public function article($filename)
    {
        // $allowed = ['png', 'jpg', 'jpeg', 'webp'];

        // $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));

        // if (!in_array($ext, $allowed)) {
        //     throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        // }

        // $path = WRITEPATH . 'uploads/articles/' . $filename;

        // if (!is_file($path)) {
        //     throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        // }

        // return $this->response
        //     ->setHeader('Content-Type', mime_content_type($path))
        //     ->setHeader('Cache-Control', 'public, max-age=3600')
        //     ->setBody(file_get_contents($path));
        return $this->serveFile(
            $filename,
            WRITEPATH . 'uploads/articles/',
            ['png', 'jpg', 'jpeg', 'webp']
        );
    }

    private function serveFile(string $filename, string $directory, array $allowedExt, string $disposition = 'inline'): \CodeIgniter\HTTP\Response
    {
        // 1. Whitelist ekstensi
        $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
        if (!in_array($ext, $allowedExt)) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        // 2. Strip path traversal
        $filename = basename($filename);

        // 3. Realpath check — pastikan tidak keluar dari direktori
        $path       = $directory . $filename;
        $realPath   = realpath($path);
        $allowedDir = realpath($directory);

        if (!$realPath || !$allowedDir || strpos($realPath, $allowedDir) !== 0) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        return $this->response
            ->setHeader('Content-Type', mime_content_type($realPath))
            ->setHeader('Content-Disposition', $disposition . '; filename="' . $filename . '"')
            ->setHeader('Cache-Control', 'public, max-age=3600')
            ->setBody(file_get_contents($realPath));
    }
}
