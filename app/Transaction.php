<?php

namespace App;

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
                array_push(static::$transactions, $line);
            }
        }
        fclose($handle);

        return static::$transactions;
    }
}