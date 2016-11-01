<?php
namespace Kartenmacherei\RestFramework\UnitTests\Response\Content;

use Kartenmacherei\RestFramework\Response\Content\ContentType;
use Kartenmacherei\RestFramework\Response\Content\JsonContentType;
use Kartenmacherei\RestFramework\Response\Content\UnsupportedContentTypeException;

/**
 * @covers \Kartenmacherei\RestFramework\Response\Content\ContentType
 */
class ContentTypeTest extends \PHPUnit_Framework_TestCase
{

    public function testReturnsJsonContentType()
    {
        $actual = ContentType::fromString(ContentType::JSON);
        $this->assertInstanceOf(JsonContentType::class, $actual);
    }

    public function testThrowsExceptionIfContentTypeIsNotSupported()
    {
        $this->expectException(UnsupportedContentTypeException::class);
        ContentType::fromString('foo');
    }

}
