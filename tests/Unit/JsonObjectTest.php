<?php
namespace Kartenmacherei\RestFramework\UnitTests;

use Kartenmacherei\RestFramework\JsonException;
use Kartenmacherei\RestFramework\JsonObject;
use Kartenmacherei\RestFramework\JsonArray;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Kartenmacherei\RestFramework\JsonObject
 * @covers \Kartenmacherei\RestFramework\JsonArray
 */
class JsonObjectTest extends TestCase
{
    /**
     * @dataProvider dataProvider
     *
     * @param mixed $data
     * @param mixed $expected
     */
    public function test($data, $expected)
    {
        $json = new JsonObject(json_decode($data));

        $actual = $json->query('foo');

        $this->assertEquals($expected, $actual);
    }

    public function testThrowsExceptionIfSelectedPropertyDoesNotExist()
    {
        $json = new JsonObject(json_decode('{"foo": "bar"}'));
        $this->expectException(JsonException::class);
        $json->query('baz');
    }

    public function dataProvider()
    {
        $stdClass = new \stdClass();
        $stdClass->bar = 'baz';

        $stdClass2 = new \stdClass();
        $stdClass2->bar = 'foobar';

        return [
            [
                '{"foo": "bar"}', 'bar'
            ],
            [
                '{"foo": {"bar": "baz"}}', new JsonObject($stdClass)
            ],
            [
                '{"foo": [{"bar":"baz"}, {"bar": "foobar"}]}',
                new JsonArray(
                    [
                        $stdClass,
                        $stdClass2
                    ]
                )
            ]
        ];
    }
}
