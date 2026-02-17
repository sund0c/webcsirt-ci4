<?php

namespace App\Controllers\Internal;

use App\Controllers\BaseController;

class Dashboard extends BaseController
{
    public function index()
    {
        return view('internal/dashboard');
    }
}
