<?php

declare(strict_types = 1);

namespace Kassner\Tests\LogParser\Format;

use Kassner\LogParser\LogParser;

/**
 * @format %D
 */
class ServeRequestTimeTest extends \PHPUnit_Framework_TestCase
{
  protected $parser;

    protected function setUp(): void
    {
        $this->parser = new LogParser();
        $this->parser->setFormat('%D');
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
        $this->assertEquals($line, $entry->timeServeRequest);
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
        return array(
            array('2966894'),
            array('4547567567'),
            array('56867'),
        );
    }

    public function invalidProvider(): array
    {
        return array(
            array(''),
            array(null),
            array('abc'),
            array(' '),
            array('-'),
        );
    }
}
