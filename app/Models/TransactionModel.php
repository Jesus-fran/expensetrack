<?php

declare(strict_types=1);

namespace App\Models;

use App\Model;
use DateTime;
use stdClass;

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
        return $transaction->fetchAll(\PDO::FETCH_FUNC, ['\App\Models\TransactionModel', 'ApplyFormat']);
    }

    public function ApplyFormat($id, $description, $check_num, $amount, $created_at, ): stdClass
    {
        return (object) [
            'id' => $id,
            'description' => $description,
            'check_num' => $check_num,
            'amount' => $this->formatMoney((float) $amount),
            'created_at' => $this->formatCreatedAt($created_at),
        ];
    }

    public function formatMoney(float $amount): array
    {
        if ($amount > 0) {
            return ['amount' => '$' . number_format($amount, 2), 'income' => ($amount > 0) ? true : false];
        }
        return [
            'amount' => str_replace('-', '-$', (string) number_format($amount, 2)),
            'income' => ($amount > 0) ? true : false
        ];
    }

    public function formatCreatedAt(string $created_at): string
    {
        $dateTime = new DateTime($created_at);
        return $dateTime->format('M d, Y');
    }
}