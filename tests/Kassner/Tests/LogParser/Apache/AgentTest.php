<?php

declare(strict_types = 1);

namespace Kassner\Tests\LogParser\Apache;

use Kassner\LogParser\LogParser;
use PHPUnit\Framework\TestCase;

class AgentTest extends TestCase
{
    public function testFormat(): void
    {
        $parser = new LogParser('%{User-agent}i');

        $entry = $parser->parse('Mozilla/5.0 (Macintosh; Intel Mac OS X 10_7_5) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/29.0.1547.65 Safari/537.36');
        $this->assertEquals('Mozilla/5.0 (Macintosh; Intel Mac OS X 10_7_5) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/29.0.1547.65 Safari/537.36', $entry->HeaderUseragent);

        $entry = $parser->parse('Mozilla/5.0 (compatible; Googlebot/2.1; +http://www.google.com/bot.html)');
        $this->assertEquals('Mozilla/5.0 (compatible; Googlebot/2.1; +http://www.google.com/bot.html)', $entry->HeaderUseragent);
    }
}
