<?php
namespace Kartenmacherei\RestFramework\Response\Content;

use PHPUnit\Framework\TestCase;

/**
 * @covers \Kartenmacherei\RestFramework\Response\Content\IcsContentType
 */
class IcsContentTypeTest extends TestCase
{
    public function testAsString()
    {
        $this->assertSame('text/calendar; charset=utf-8', (new IcsContentType())->asString());
    }
}
