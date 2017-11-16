<?php
namespace Kartenmacherei\RestFramework\UnitTests\Request;

use Kartenmacherei\RestFramework\Request\Pattern;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Kartenmacherei\RestFramework\Request\Pattern
 */
class PatternTest extends TestCase
{
    /**
     * @dataProvider patternValueProvider
     *
     * @param string $patternValue
     * @param string $expectedString
     */
    public function testAsString($patternValue, $expectedString)
    {
        $pattern = new Pattern($patternValue);
        $this->assertSame($expectedString, $pattern->asString());
    }

    /**
     * @return array
     */
    public static function patternValueProvider()
    {
        return [
            ['foo/bar', '/foo\/bar/'],
            ['/baskets/\w+$', '/\/baskets\/\w+$/']
        ];
    }
}
