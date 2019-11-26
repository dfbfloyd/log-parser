<?php
declare(strict_types = 1);

namespace Kassner\Tests\LogParser\Provider;

use PHPUnit\Framework\TestCase;

/**
 * The InvalidProvider provides test cases that should trigger a TypeError if validated against a particular data type.
 *
 * @package Kassner\LogParse
 * @author  Don Bowlby <dfbfloyd@gmail.com>
 */
class InvalidProvider extends TestCase
{

  public function getInvalidStrings(): array
  {
    return [
      [0, \TypeError::class],
      [1, \TypeError::class],
      [4, \TypeError::class],
      [1.4, \TypeError::class],
      [-3, \TypeError::class],
      [-6.2, \TypeError::class],
      [true, \TypeError::class],
      [false, \TypeError::class],
      [null, \TypeError::class],
      [[], \TypeError::class],
      [[0 => 'test value'], \TypeError::class]
    ];
  }

}
