<?php

namespace App\Exceptions;

class NotFoundException extends \Exception
{
    protected $message = 'Error not found page :c';
    protected $code = 404;
}