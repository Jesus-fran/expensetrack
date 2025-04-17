<?php

declare(strict_types=1);

namespace App;

final class Greeter
{
    public function greet(string $name)
    {
        return 'Hello, ' . $name . '!';
    }
}