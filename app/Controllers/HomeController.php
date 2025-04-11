<?php

namespace App\Controllers;

use App\Transaction;
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

    public function save()
    {
        $transaction = Transaction::extractFromFile($_FILES['transaction']);

        echo "<pre>";
        print_r($transaction);
        echo "</pre>";

    }
}
