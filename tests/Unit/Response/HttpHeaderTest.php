<?php
namespace Kartenmacherei\RestFramework\UnitTests\Response;

use Kartenmacherei\RestFramework\Response\HttpHeader;
use PHPUnit_Framework_TestCase;

/**
 * @covers \Kartenmacherei\RestFramework\Response\HttpHeader
 */
class HttpHeaderTest extends PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider headerDataProvider
     *
     * @param string $name
     * @param string $value
     * @param string $expectedString
     */
    public function testAsString(string $name, string $value, string $expectedString)
    {
        $header = new HttpHeader($name, $value);
        $this->assertSame($expectedString, $header->asString());
    }

    /**
     * @return array
     */
    public static function headerDataProvider(): array
    {
        return [
            ['Allow', 'GET,POST', 'Allow: GET,POST'],
            ['Foo', 'bar', 'Foo: bar']
        ];
    }
}
