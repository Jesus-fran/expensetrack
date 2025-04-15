<?php

namespace App;

use DateTime;

class Transaction
{

    public int $id;
    public string $description;
    public ?int $check_num;
    public float $amount;
    public string|DateTime $created_at;
    public bool $income;
    protected static array $transactions = [];

    public static float $totalIncome = 0;
    public static float $totalExpense = 0;
    public static float $netTotal = 0;

    public function __construct()
    {
        $this->created_at = new DateTime($this->created_at);
        $this->income = ($this->amount > 0) ? true : false;

        if ($this->amount > 0) {
            static::$totalIncome += $this->amount;
        } else {
            static::$totalExpense += $this->amount;

        }
        static::$netTotal += $this->amount;
    }

    public function getFormatedAmount(): string
    {
        if ($this->amount > 0) {
            return '$' . number_format($this->amount, 2);
        }
        return str_replace('-', '-$', (string) number_format($this->amount, 2));
    }

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