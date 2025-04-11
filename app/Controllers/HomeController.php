<?php

namespace App\Controllers;

use App\Models\TransactionModel;
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

        $transactionModel = new TransactionModel();
        $dataTransaction = $transactionModel->createMany($transaction);

        echo "<pre>";
        print_r($dataTransaction);
        echo "</pre>";
    }
}
