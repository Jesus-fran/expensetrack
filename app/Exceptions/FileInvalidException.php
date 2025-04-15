<?php

namespace App\Exceptions;

class FileInvalidException extends \Exception
{
    protected $message = 'Invalid file is not csv';
}