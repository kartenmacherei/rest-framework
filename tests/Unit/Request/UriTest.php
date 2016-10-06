<?php
namespace Kartenmacherei\RestFramework\UnitTests\Request;

use Kartenmacherei\RestFramework\EnsureException;
use Kartenmacherei\RestFramework\Request\Pattern;
use Kartenmacherei\RestFramework\Request\Uri;
use Kartenmacherei\RestFramework\Request\UriException;
use PHPUnit_Framework_MockObject_MockObject;
use PHPUnit_Framework_TestCase;

/**
 * @covers \Kartenmacherei\RestFramework\Request\Uri
 */
class UriTest extends PHPUnit_Framework_TestCase
{
    public function testAsString()
    {
        $uri = new Uri('/foo/bar');
        $this->assertSame('/foo/bar', $uri->asString());
    }

    public function testGetPathSegment()
    {
        $uri = new Uri('/foo/bar/baz');
        $this->assertSame('foo', $uri->getPathSegment(0));
        $this->assertSame('bar', $uri->getPathSegment(1));
        $this->assertSame('baz', $uri->getPathSegment(2));
    }

    public function testGetPathSegmentsThrowsExceptionIfIndexIsOutOfBounds()
    {
        $uri = new Uri('/foo/bar');
        $this->expectException(UriException::class);
        $uri->getPathSegment(2);
    }

    public function testGetPathSegmentsThrowsExceptionIfIndexIsNegative()
    {
        $uri = new Uri('/foo/bar');
        $this->expectException(EnsureException::class);
        $uri->getPathSegment(-1);
    }

    /**
     * @dataProvider patternProvider
     *
     * @param string $uriValue
     * @param string $patternValue
     * @param bool $expectedResult
     */
    public function testMatches($uriValue, $patternValue, $expectedResult)
    {
        $uri = new Uri($uriValue);
        $pattern = $this->getPatternMock();
        $pattern->method('asString')->willReturn($patternValue);

        $this->assertSame($expectedResult, $uri->matches($pattern));
    }

    /**
     * @return array
     */
    public static function patternProvider()
    {
        return [
            ['/foo/bar', '/\/foo\/bar/', true],
            ['/foo/bar', '/\/foo\/baz/', false]
        ];
    }

    /**
     * @return PHPUnit_Framework_MockObject_MockObject|Pattern
     */
    private function getPatternMock()
    {
        return $this->createMock(Pattern::class);
    }

}
