<?php
namespace Kartenmacherei\RestFramework\Response\Content;

use PHPUnit_Framework_TestCase;

/**
 * @covers \Kartenmacherei\RestFramework\Response\Content\IcsContentType
 */
class IcsContentTypeTest extends PHPUnit_Framework_TestCase
{
    public function testAsString()
    {
        $this->assertSame('text/calendar; charset=utf-8', (new IcsContentType())->asString());
    }
}
