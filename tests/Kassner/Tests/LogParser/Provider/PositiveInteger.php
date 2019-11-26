<?php

declare(strict_types = 1);

namespace Kassner\Tests\LogParser\Provider;
use PHPUnit\Framework\TestCase;

class PositiveInteger extends TestCase
{
    public function successProvider(): array
    {
        return [
            ['1'],
            ['1234'],
            ['99999999'],
            ['100000000000000000000000'],
            ['0'],
        ];
    }

    public function invalidProvider(): array
    {
        return [
            ['-1'],
            ['dummy 1234'],
            ['lala'],
            ['-'],
            ['-100000000000000000000000'],
            ['12.34'],
            ['0.0'],
            ['-0'],
        ];
    }
}
