<?php

declare(strict_types = 1);

namespace Kassner\Tests\LogParser\Format;

use Kassner\LogParser\LogParser;
use PHPUnit\Framework\TestCase;

/**
 * @format %%
 * @description The percent sign
 */
class PercentTest extends TestCase
{
    protected $parser;

    protected function setUp(): void
    {
        $this->parser = new LogParser();
        $this->parser->setFormat('%%');
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
        $this->assertEquals($line, $entry->percent);
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
            ['%'],
        ];
    }

    public function invalidProvider(): array
    {
        return [
            ['0'],
            ['1'],
            ['dummy 1234'],
            ['lala'],
            ['-'],
        ];
    }
}
