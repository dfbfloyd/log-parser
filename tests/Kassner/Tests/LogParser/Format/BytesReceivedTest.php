<?php

declare(strict_types = 1);

namespace Kassner\Tests\LogParser\Format;

use Kassner\LogParser\LogParser;
use Kassner\Tests\LogParser\Provider\PositiveInteger as PositiveIntegerProvider;

/**
 * @format %I
 * @description Bytes received, including request and headers, cannot be zero. You need to enable mod_logio to use this.
 */
class BytesReceivedTest extends PositiveIntegerProvider
{
    protected $parser = null;

    protected function setUp(): void
    {
        $this->parser = new LogParser();
        $this->parser->setFormat('%I');
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
        $this->assertEquals($line, $entry->receivedBytes);
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
