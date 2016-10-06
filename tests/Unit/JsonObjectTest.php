<?php
namespace Kartenmacherei\RestFramework\UnitTests;

use Kartenmacherei\RestFramework\JsonObject;
use Kartenmacherei\RestFramework\JsonArray;

/**
 * @covers \Kartenmacherei\RestFramework\JsonObject
 * @covers \Kartenmacherei\RestFramework\JsonArray
 */
class JsonObjectTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider dataProvider
     */
    public function test($data, $expected)
    {
        $json = new JsonObject(json_decode($data));

        $actual = $json->query('foo');

        $this->assertEquals($expected, $actual);
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
