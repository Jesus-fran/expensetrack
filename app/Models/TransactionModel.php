<?php

declare(strict_types=1);

namespace App\Models;

use App\Model;

class TransactionModel extends Model
{
    public function createMany(array $transaction)
    {
        $query = $this->db->prepare('INSERT INTO transactions (description, check_num, amount, created_at) VALUE(:description,:check_num,:amount,:created_at)');

        foreach ($transaction as $transactionItem) {
            $query->execute($transactionItem);
        }
    }

    public function get(): array
    {
        $transaction = $this->db->prepare('SELECT * FROM transactions');
        $transaction->execute();
        return $transaction->fetchAll(\PDO::FETCH_CLASS, '\App\Transaction');
    }
}