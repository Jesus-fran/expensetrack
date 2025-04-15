<?php

namespace App\Controllers;

use App\Exceptions\FileInvalidException;
use App\Models\TransactionModel;
use App\Transaction;
use App\View;

class HomeController
{
    public function index(): View
    {
        $transactionsModel = new TransactionModel();
        $transactions = $transactionsModel->get();

        if (isset(Transaction::$totalIncome, Transaction::$totalExpense, Transaction::$netTotal)) {
            $totalIncome = Transaction::$totalIncome->getFormated();
            $totalExpense = Transaction::$totalExpense->getFormated();
            $netTotal = Transaction::$netTotal->getFormated();
        }

        return View::make('index.php', [
            'transactions' => $transactions,
            'totalIncome' => $totalIncome ?? null,
            'totalExpense' => $totalExpense ?? null,
            'netTotal' => $netTotal ?? null
        ], 'layout.php');
    }

    public function create(): View
    {
        return View::make('create.php', [], layoutName: 'layout.php');
    }

    public function save()
    {
        try {
            $transaction = Transaction::extractFromFile($_FILES['transaction']);
        } catch (FileInvalidException $e) {
            header('Location: /create?error='.$e->getMessage());
        }

        $transactionModel = new TransactionModel();
        $transactionModel->createMany($transaction ?? null);

        header('Location: /');
    }
}
