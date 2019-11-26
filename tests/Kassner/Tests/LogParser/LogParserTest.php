<?php

declare(strict_types = 1);

namespace Kassner\Tests\LogParser;

use Kassner\LogParser\FormatException;
use Kassner\LogParser\LogParser;
use PHPUnit\Framework\TestCase;
use stdClass;
use TypeError;

/**
 * This class contains unit test methods for the LogParser class.
 *
 * @package Kassner\LogParser
 * @author  Don Bowlby <dfbfloyd@gmail.com>
 */
class LogParserTest extends TestCase
{
  protected $parser;

  public function setUp(): void
  {
    $this->parser = new LogParser();
  }

  /**
   * Tests that the LogParser::getDefaultFormat method is returning the expected format.
   *
   * @covers LogParser::getDefaultFormat()
   */
  public function testGetDefaultFormat(): void
  {
    $result = LogParser::getDefaultFormat();
    $this->assertSame('%h %l %u %t "%r" %>s %b', $result); // must be changed if class changes
  }

  public function providerTestParse(): array
  {
    // each case consists of a log line, an attribute to search for and the class being returned
    $exception_cases = [
      [0, 'placeholder - attribute not relevant for this test case', TypeError::class],
      [1, 'placeholder - attribute not relevant for this test case', TypeError::class],
      [4, 'placeholder - attribute not relevant for this test case', TypeError::class],
      [1.4, 'placeholder - attribute not relevant for this test case', TypeError::class],
      [-3, 'placeholder - attribute not relevant for this test case', TypeError::class],
      [-6.2, 'placeholder - attribute not relevant for this test case', TypeError::class],
      [true, 'placeholder - attribute not relevant for this test case', TypeError::class],
      [false, 'placeholder - attribute not relevant for this test case', TypeError::class],
      [null, 'placeholder - attribute not relevant for this test case', TypeError::class],
      [[], 'placeholder - attribute not relevant for this test case', TypeError::class],
      [[0 => 'test value'], 'placeholder - attribute not relevant for this test case', TypeError::class],
      ['somestring| ', 'placeholder - attribute not relevant for this test case', FormatException::class],
    ];

    // each case consists of a log line, an attribute to search for and the class being returned
    $valid_cases = [
      ['127.0.0.1 - - [11/Dec/2018:13:56:50 -0500] "GET /index.php?img=pngWrench HTTP/1.1" 200 741', 'host', stdClass::class],
      ['127.0.0.1 - - [11/Dec/2018:13:56:50 -0500] "GET /index.php?img=pngWrench HTTP/1.1" 200 741', 'logname', stdClass::class],
      ['127.0.0.1 - - [11/Dec/2018:13:56:50 -0500] "GET /index.php?img=pngWrench HTTP/1.1" 200 741', 'user', stdClass::class],
      ['127.0.0.1 - - [11/Dec/2018:13:56:50 -0500] "GET /index.php?img=pngWrench HTTP/1.1" 200 741', 'stamp', stdClass::class],
      ['127.0.0.1 - - [11/Dec/2018:13:56:50 -0500] "GET /index.php?img=pngWrench HTTP/1.1" 200 741', 'time', stdClass::class],
      ['127.0.0.1 - - [11/Dec/2018:13:56:50 -0500] "GET /index.php?img=pngWrench HTTP/1.1" 200 741', 'request', stdClass::class],
      ['127.0.0.1 - - [11/Dec/2018:13:56:50 -0500] "GET /index.php?img=pngWrench HTTP/1.1" 200 741', 'status', stdClass::class],
      ['127.0.0.1 - - [11/Dec/2018:13:56:50 -0500] "GET /index.php?img=pngWrench HTTP/1.1" 200 741', 'responseBytes', stdClass::class],
    ];

    return array_merge($valid_cases, $exception_cases);
  }

  /**
   * This method tests the LogParser->parse() method to ensure it's returning an instance of stdClass.
   *
   * @covers ::LogParser->parse()
   * @dataProvider providerTestParse
   *
   * @param mixed $line     Input values to pass LogParser->parse()
   * @param string $attribute Name of the attribute to search for
   * @param mixed $expected Expected result returned from LogParser->parse()
   */
  public function testParse($line, $attribute, $expected): void
  {
    // sets up exceptions thrown by getTimeInSeconds()
    if (TypeError::class === $expected || FormatException::class === $expected) {
      $this->setupExpectedException($expected);
    }

    $parse_result = $this->parser->parse($line);
    $this->assertObjectHasAttribute($attribute, $parse_result);

  }

  /**
   * Setup the expected exception, if there is one.
   *
   * This method outputs an error message and writes it to the error log
   * if a PHPUnit/Framework/Exception is thrown.
   *
   * @param string $expected_exception Expected exception in the format
   */
  private function setupExpectedException(string $expected_exception)
  {
    try {

      if (!empty($expected_exception)) {
        $this->expectException($expected_exception);
      }

    } catch (\Throwable $e) {
      $log_msg = 'Test failed in ' . __METHOD__ . ' Expected Exception passed: ' . $expected_exception;
      echo $log_msg, PHP_EOL;
      error_log($log_msg);
    }

  }

  public function tearDown(): void
  {
    unset($this->parser);
  }
}
