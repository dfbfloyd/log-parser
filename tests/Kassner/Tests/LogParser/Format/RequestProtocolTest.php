<?php

declare(strict_types = 1);

namespace Kassner\Tests\LogParser\Format;

use Kassner\LogParser\LogParser;
use PHPUnit\Framework\TestCase;

/**
 * @format %H
 * @description The request protocol
 */
class RequestProtocolTest extends TestCase
{
  protected $parser;

    protected function setUp(): void
    {
        $this->parser = new LogParser();
        $this->parser->setFormat('%H');
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
        $this->assertEquals($line, $entry->requestProtocol);
    }

    /**
     * @expectedException \Kassner\LogParser\FormatException
     * @dataProvider invalidProvider
     */
    public function testInvalid($line): void
    {
        $this->parser->parse($line);
    }

    public function successProvider(): array
    {
        return [
            ['HTTP/1.0'],
            ['HTTP/1.1'],
            ['HTTP/2.0'],
        ];
    }

    public function invalidProvider(): array
    {
        return [
            [''],
            ['HTTP/1x0'],
            ['HTTP/1x1'],
            ['HTTP/2x0'],
            ['HTTP/3.0'],
        ];
    }
}
