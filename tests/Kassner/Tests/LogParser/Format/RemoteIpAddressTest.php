<?php

declare(strict_types = 1);

namespace Kassner\Tests\LogParser\Format;

use Kassner\LogParser\LogParser;
use Kassner\Tests\LogParser\Provider\IpAddress as IpAddressProvider;

/**
 * @format %a
 * @description Remote IP-address
 */
class RemoteIpAddressTest extends IpAddressProvider
{
    protected $parser = null;

    protected function setUp(): void
    {
        $this->parser = new LogParser();
        $this->parser->setFormat('%a');
    }

    protected function tearDown(): void
    {
        $this->parser = null;
    }

    /**
     * @dataProvider successProvider
     */
    public function testSuccess($line): void
    {
        $entry = $this->parser->parse($line);
        $this->assertEquals($line, $entry->remoteIp);
    }

    /**
     * @expectedException \Kassner\LogParser\FormatException
     * @dataProvider invalidProvider
     */
    public function testInvalid($line): void
    {
        $this->parser->parse($line);
    }
}
