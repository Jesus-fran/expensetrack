<?php

namespace App;

use DateTime;

class Transaction
{
    protected static array $transactions = [];

    public static function extractFromFile(array $fileUploaded): array
    {
        $tmpNameFile = $fileUploaded['tmp_name'];
        $typeFile = $fileUploaded['type'];

        if (!($typeFile === 'text/csv')) {
            throw new \Exception('File invalid, not is a csv :c');
        }

        $handle = fopen($tmpNameFile, "r");
        if ($handle) {
            fgets($handle);
            while (($line = fgetcsv($handle)) !== false) {
                array_push(static::$transactions, static::formatTransaction($line));
            }
        }
        fclose($handle);

        return static::$transactions;
    }

    protected static function formatTransaction(array $transaction): array
    {
        [$created_at, $checkNum, $description, $amount] = $transaction;

        $created_at = DateTime::createFromFormat('m/d/Y', $created_at)
            ->setTime(0, 0)->format('Y-m-d H:i:s');

        $amount = str_replace(['$', ','], '', $amount);

        return [
            'created_at' => $created_at,
            'check_num' => $checkNum ?: NULL,
            'description' => $description,
            'amount' => $amount,
        ];
    }
}