<?php

declare(strict_types = 1);

namespace Kassner\Tests\LogParser\Format;

use Kassner\LogParser\LogParser;

/**
 * @format %T
 * @description The request time
 */
class RequestTimeTest extends \PHPUnit_Framework_TestCase
{
    protected $parser = null;

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
        return array(
            array('0.000'),
            array('1.234'),
            array('999.999'),
            // apache provides %T without the milisecond part
            array('3'),
            array('0'),
        );
    }

    public function invalidProvider(): array
    {
        return array(
            array('abc '),
            array(null),
            array(''),
            array(' '),
            array('-'),
        );
    }
}
