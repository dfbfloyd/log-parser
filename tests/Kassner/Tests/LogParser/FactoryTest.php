<?php

declare(strict_types = 1);

namespace Kassner\Tests\LogParser;

use Kassner\LogParser\Factory;
use Kassner\LogParser\LogParser;
use PHPUnit\Framework\TestCase;

/**
 * This class is used to unit test the methods contained in the Factory class.
 *
 * @package Kassner\LogParser
 * @author  Don Bowlby <dfbfloyd@gmail.com>
 */
class FactoryTest extends TestCase
{

  /**
   * Tests the Factory::create method
   *
   * @covers \Kassner\LogParser\Factory::create
   *
   * @throws \PHPUnit\Framework\ExpectationFailedException
   * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
   */
  public function testCreate(): void
  {
    $result = Factory::create();
    $this->assertEquals(new LogParser(), $result);
  }
}
