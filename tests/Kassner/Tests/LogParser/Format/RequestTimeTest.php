<?php

declare(strict_types = 1);

namespace Kassner\Tests\LogParser\Format;

use Kassner\LogParser\LogParser;
use PHPUnit\Framework\TestCase;

/**
 * @format %T
 * @description The request time
 */
class RequestTimeTest extends TestCase
{
  protected $parser;

    protected function setUp(): void
    {
        $this->parser = new LogParser();
        $this->parser->setFormat('%T');
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
        $this->assertEquals($line, $entry->requestTime);
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
            ['0.000'],
            ['1.234'],
            ['999.999'],
            // apache provides %T without the miLlisecond part
            ['3'],
            ['0'],
        ];
    }

    public function invalidProvider(): array
    {
        return [
            ['abc '],
            [null],
            [''],
            [' '],
            ['-'],
        ];
    }
}
