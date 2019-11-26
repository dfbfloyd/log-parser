<?php

declare(strict_types = 1);

namespace Kassner\LogParser;

/**
 * The Factory class builds new LogParsers for us.
 *
 * @package Kassner\LogParser
 * @author  Rafael Kassner <kassner@gmail.com>
 * @author  Don Bowlby <dfbfloyd@gmail.com>
 */
class Factory
{
    private static $parser;

    /**
     * Return an instance of LogParser.
     *
     * @return \Kassner\LogParser\LogParser
     */
    public static function create(): LogParser
    {
      if (!self::$parser) {
        self::$parser = new LogParser();
      }

      return self::$parser;
    }
}
