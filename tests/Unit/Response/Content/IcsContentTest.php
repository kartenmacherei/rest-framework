<?php
namespace Kartenmacherei\RestFramework\Response\Content;


use PHPUnit\Framework\TestCase;
/**
 * @covers \Kartenmacherei\RestFramework\Response\Content\IcsContent
 */
class IcsContentTest extends TestCase
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
