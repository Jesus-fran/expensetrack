<?php

namespace Tests\Unit\DataProvider;

class RouterDataProvider
{
    public static function AdditionProvider(): array
    {
        return [
            'When route is incorrect' => ['/invoice-asdfasdf', 'get'],
            'When method is incorrect' => ['/invoice', 'post'],
            'When method and route is correct but class is not' => ['/invoice', 'get'],
            'When method of class is incorrect' => ['/user', 'get'],
            'When callback is incorrect or nullable' => ['/email', 'get'],
        ];
    }
}