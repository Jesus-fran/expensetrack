<?php

namespace App;

use App\Exceptions\FileInvalidException;
use DateTime;

class Transaction
{
    public int $id;
    public string $description;
    public ?int $check_num;
    public float|Money $amount;
    public string|DateTime $created_at;
    public bool $income;
    protected static array $transactions = [];
    public static Money $totalIncome;
    public static Money $totalExpense;
    public static Money $netTotal;

    public function __construct()
    {
        $this->amount = new Money($this->amount);
        $this->created_at = new DateTime($this->created_at);
        $amount = $this->amount->value;
        $this->income = ($amount > 0) ? true : false;

        if (!isset(static::$totalIncome)) {
            static::$totalIncome = new Money();
        }
        if (!isset(static::$totalExpense)) {
            static::$totalExpense = new Money();
        }
        if (!isset(static::$netTotal)) {
            static::$netTotal = new Money();
        }

        if ($amount > 0) {
            static::$totalIncome->add($amount);
        } else {
            static::$totalExpense->add($amount);
        }
        static::$netTotal->add($amount);
    }

    public static function extractFromFile(array $filesUploaded): array
    {
        foreach ($filesUploaded['tmp_name'] as $key => $tmpNameFile) {
            $typeFile = $filesUploaded['type'][$key];

            if (!($typeFile === 'text/csv')) {
                throw new FileInvalidException();
            }

            $handle = fopen($tmpNameFile, "r");
            if ($handle) {
                fgets($handle);
                while (($line = fgetcsv($handle)) !== false) {
                    array_push(static::$transactions, static::formatTransaction($line));
                }
            }
            fclose($handle);
        }

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