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

        $totalIncome = Transaction::$totalIncome->getFormated();
        $totalExpense = Transaction::$totalExpense->getFormated();
        $netTotal = Transaction::$netTotal->getFormated();

        return View::make('index.php', [
            'transactions' => $transactions,
            'totalIncome' => $totalIncome,
            'totalExpense' => $totalExpense,
            'netTotal' => $netTotal
        ]);
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
