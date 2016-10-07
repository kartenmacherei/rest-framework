<?php
namespace Kartenmacherei\RestFramework\UnitTests\Request;

use Kartenmacherei\RestFramework\Request\Body\EmptyBody;
use Kartenmacherei\RestFramework\Request\Header\HeaderCollection;
use Kartenmacherei\RestFramework\Request\Method\DeleteRequestMethod;
use Kartenmacherei\RestFramework\Request\Method\GetRequestMethod;
use Kartenmacherei\RestFramework\Request\Method\OptionsRequestMethod;
use Kartenmacherei\RestFramework\Request\Method\PatchRequestMethod;
use Kartenmacherei\RestFramework\Request\Method\PostRequestMethod;
use Kartenmacherei\RestFramework\Request\Method\PutRequestMethod;
use Kartenmacherei\RestFramework\Request\Method\RequestMethod;
use Kartenmacherei\RestFramework\Request\Method\UnsupportedRequestMethodException;
use Kartenmacherei\RestFramework\Request\Request;
use Kartenmacherei\RestFramework\Request\Uri;
use PHPUnit_Framework_TestCase;

/**
 * @covers \Kartenmacherei\RestFramework\Request\Request
 * @covers \Kartenmacherei\RestFramework\Request\Uri
 * @covers \Kartenmacherei\RestFramework\Request\Body\Body
 * @covers \Kartenmacherei\RestFramework\Request\Header\HeaderCollection
 */
class RequestTest extends PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider methodProvider
     *
     * @param string $method
     * @param string $expectedClass
     */
    public function testFromSuperGlobalsCreatesInstanceWithExpectedRequestMethod($method, $expectedClass)
    {
        $_SERVER['REQUEST_URI'] = '/foo';
        $_SERVER['REQUEST_METHOD'] = $method;

        $request = Request::fromSuperGlobals();
        $this->assertInstanceOf($expectedClass, $request->getMethod());
    }

    public function testFromSuperGlobalsThrowsExceptionWhenRequestMethodIsNotSupported()
    {
        $_SERVER['REQUEST_URI'] = '/foo';
        $_SERVER['REQUEST_METHOD'] = 'foo';

        $this->expectException(UnsupportedRequestMethodException::class);
        Request::fromSuperGlobals();
    }

    public function testGetUri()
    {
        $uri = new Uri('/foo');
        $request = new Request(new GetRequestMethod(), $uri, new EmptyBody(), new HeaderCollection());

        $this->assertSame($uri, $request->getUri());
    }

    /**
     * @return array
     */
    public static function methodProvider()
    {
        return [
            [RequestMethod::OPTIONS, OptionsRequestMethod::class],
            [RequestMethod::GET, GetRequestMethod::class],
            [RequestMethod::DELETE, DeleteRequestMethod::class],
            [RequestMethod::PATCH, PatchRequestMethod::class],
            [RequestMethod::POST, PostRequestMethod::class],
            [RequestMethod::PUT, PutRequestMethod::class]
        ];
    }
}
