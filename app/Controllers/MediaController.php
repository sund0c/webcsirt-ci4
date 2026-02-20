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
}
