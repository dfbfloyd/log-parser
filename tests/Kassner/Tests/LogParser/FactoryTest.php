<?php

declare(strict_types = 1);

namespace Kassner\Tests\LogParser;

use Kassner\LogParser\Factory;
use Kassner\LogParser\LogParser;
use PHPUnit\Framework\TestCase;

class FactoryTest extends TestCase
{

  public $parser;

  public function setUp(): void
  {
    $this->parser = new LogParser();
  }

  public static function testCreate(): void
  {
    $result = Factory::create();
    $this->assertSame($this->parser, $result);
  }
}
