<?php

namespace App\Controllers;

use App\Models\TransactionModel;
use App\Transaction;
use App\View;

class HomeController
{
    public function index(): View
    {
        $transactionsModel = new TransactionModel();
        $transactions = $transactionsModel->get();
        echo '<pre>';
        var_dump($transactions);
        echo '</pre>';
        exit;
        // $totalIcome = Transaction::calculateIcome($transactions);
        // $totalExpense = Transaction::calculateExpense($transactions);
        // $netTotal = Transaction::calculateTotal($transactions);

        return View::make('index.php', ['transactions' => $transactions]);
    }

    public function create(): View
    {
        return View::make('create.php');
    }

    public function save()
    {
        $transaction = Transaction::extractFromFile($_FILES['transaction']);

        $transactionModel = new TransactionModel();
        $transactionModel->createMany($transaction);

        header('Location: /');
    }
}
