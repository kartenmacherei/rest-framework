<?php
namespace Kartenmacherei\RestFramework\UnitTests\Response\Content;

use Kartenmacherei\RestFramework\EnsureException;
use Kartenmacherei\RestFramework\Response\Content\PhpObjectContent;
use Kartenmacherei\RestFramework\Response\Content\PlainContentType;
use PHPUnit\Framework\TestCase;
use stdClass;

/**
 * @covers \Kartenmacherei\RestFramework\Response\Content\PhpObjectContent
 */
class PhpObjectContentTest extends TestCase
{
    public function testReturnsExpectedContentType()
    {
        $content = new PhpObjectContent(new stdClass());
        $this->assertInstanceOf(PlainContentType::class, $content->getContentType());
    }

    public function testReturnsExpectedString()
    {
        $object = new stdClass();
        $object->foo = "bar";
        $object->bar = "foo";

        $content = new PhpObjectContent($object);

        $expected = 'O:8:"stdClass":2:{s:3:"foo";s:3:"bar";s:3:"bar";s:3:"foo";}';
        $actual = $content->asString();

        $this->assertSame($expected, $actual);
    }

    /**
     * @dataProvider invalidValueProvider
     *
     * @param mixed $invalidValue
     */
    public function testThrowsExceptionIfUsedWithInvalidValue($invalidValue)
    {
        $this->expectException(EnsureException::class);
        new PhpObjectContent($invalidValue);
    }

    public static function invalidValueProvider()
    {
        return [
            ['foo'],
            [12],
            [12.1],
            [['foo' => 'bar']]
        ];
    }
}
