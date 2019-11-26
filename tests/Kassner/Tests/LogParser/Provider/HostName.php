<?php

declare(strict_types = 1);

namespace Kassner\Tests\LogParser\Provider;

use PHPUnit\Framework\TestCase;

class HostName extends TestCase
{
    public function successProvider(): array
    {
        return [
            ['php.net'],
            ['www.php.net'],
            ['localhost'],
            ['localhost.localdomain'],
            ['pt-br.php.net'],
            ['php-net'],
        ];
    }

    public function invalidProvider(): array
    {
        return [
            [''],
            /* @TODO check for invalid hostnames. In fact, there are many hostnames that are
              invalid on an internet environment, but it could be assigned a valid hostname
              on local DNS servers and VirtualHost directive */
        ];
    }
}
