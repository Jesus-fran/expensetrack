<?php

namespace App\Models;

use App\Model;

class TransactionModel extends Model
{
    public function createMany(array $transaction)
    {
        $query = $this->db->prepare('INSERT INTO transactions (description, check_num, amount, created_at) VALUE(:description,:check_num,:amount,:created_at)');

        return $insert = $query->execute($transaction[0]);
    }
}