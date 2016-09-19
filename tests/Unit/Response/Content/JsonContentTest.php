<?php
namespace Kartenmacherei\RestFramework\UnitTests\Response\Content;

use Kartenmacherei\RestFramework\Response\Content\EncodeException;
use Kartenmacherei\RestFramework\Response\Content\JsonContent;
use Kartenmacherei\RestFramework\Response\Content\JsonContentType;
use PHPUnit_Framework_TestCase;

/**
 * @covers \Kartenmacherei\RestFramework\Response\Content\JsonContent
 */
class JsonContentTest extends PHPUnit_Framework_TestCase
{
    public function testGetContentType()
    {
        $this->assertInstanceOf(JsonContentType::class, (new JsonContent(''))->getContentType());
    }

    public function testThrowsExceptionIfDataCannotBeEncodedToJson()
    {
        $this->expectException(EncodeException::class);
        new JsonContent(fopen('php://memory', 'r'));
    }

    /**
     * @dataProvider jsonDataProvider
     *
     * @param mixed $data
     * @param string $expectedJsonString
     */
    public function testAsString($data, string $expectedJsonString)
    {
        $content = new JsonContent($data);
        $this->assertJsonStringEqualsJsonString($expectedJsonString, $content->asString());
    }

    public static function jsonDataProvider()
    {
        return [
            ['foo', '"foo"'],
            [[0,1,2], '[0,1,2]'],
            [['foo' => 1, 'bar' => 2], '{"foo":1,"bar":2}'],
        ];
    }
}
