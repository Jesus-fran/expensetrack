<?php

namespace App;

class Money
{
    public function __construct(public float $value = 0)
    {
    }

    public function getFormated(): string
    {
        if ($this->value > 0) {
            return '$' . number_format($this->value, 2);
        }
        return str_replace('-', '-$', (string) number_format($this->value, 2));
    }

    public function add(float $value)
    {
        $this->value += $value;
    }
}