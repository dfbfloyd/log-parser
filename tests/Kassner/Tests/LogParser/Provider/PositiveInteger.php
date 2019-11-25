<?php

declare(strict_types = 1);

namespace Kassner\Tests\LogParser\Provider;
use PHPUnit\Framework\TestCase;

class PositiveInteger extends TestCase
{
    public function successProvider(): array
    {
        return array(
            array('1'),
            array('1234'),
            array('99999999'),
            array('100000000000000000000000'),
            array('0'),
        );
    }

    public function invalidProvider(): array
    {
        return array(
            array('-1'),
            array('dummy 1234'),
            array('lala'),
            array('-'),
            array('-100000000000000000000000'),
            array('12.34'),
            array('0.0'),
            array('-0'),
        );
    }
}
