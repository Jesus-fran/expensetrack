<?php

declare(strict_types=1);
use App\Greeter;
use PHPUnit\Framework\TestCase;

final class GreeterTest extends TestCase
{
    public function testGreetWithName()
    {
        $greeter = new Greeter();
        $greeting = $greeter->greet('Alice');
        $this->assertSame('Hello, Alice!', $greeting);
    }
}