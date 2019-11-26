<?php

declare(strict_types = 1);

namespace Kassner\Tests\LogParser\Format;

use Kassner\LogParser\LogParser;
use PHPUnit\Framework\TestCase;

/**
 * @format %S
 * @description Scheme
 */
class SchemeTest extends TestCase
{
  protected $parser;

    protected function setUp(): void
    {
        $this->parser = new LogParser();
        $this->parser->setFormat('%S');
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
        $this->assertEquals($line, $entry->scheme);
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
            ['http'],
            ['https'],
        ];
    }

    public function invalidProvider(): array
    {
        return [
            ['http '],
            ['ftp'],
            [''],
            ['h2'],
            ['1'],
        ];
    }
}
