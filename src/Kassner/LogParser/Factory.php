<?php

declare(strict_types = 1);

namespace Kassner\LogParser;

class Factory
{
    /**
     * Creates a LogParser instance.
     *
     * @return \Kassner\LogParser\LogParser
     */
    public static function create(): LogParser
    {
        return new LogParser();
    }
}
