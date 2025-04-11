<?php

namespace App\Controllers;

use App\View;

class HomeController
{
    public function index(): View
    {
        return View::make('index.php');
    }

    public function create(): View
    {
        return View::make('create.php');
    }
}
