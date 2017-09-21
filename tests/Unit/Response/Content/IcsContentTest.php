<?php
namespace Kartenmacherei\RestFramework\Response\Content;


use PHPUnit_Framework_TestCase;
/**
 * @covers \Kartenmacherei\RestFramework\Response\Content\IcsContent
 */
class IcsContentTest extends PHPUnit_Framework_TestCase
{
    public function testGetContentType()
    {
        $this->assertInstanceOf(IcsContentType::class, (new IcsContent(''))->getContentType());
    }

    public function testAsString()
    {
        $content = new IcsContent('Test');
        $this->assertSame('Test', $content->asString());
    }
}
