<?php
namespace Kartenmacherei\RestFramework\UnitTests\Request;

use Kartenmacherei\RestFramework\Request\DeleteRequest;
use Kartenmacherei\RestFramework\Request\GetRequest;
use Kartenmacherei\RestFramework\Request\Header\Header;
use Kartenmacherei\RestFramework\Request\Header\HeaderCollection;
use Kartenmacherei\RestFramework\Request\Header\HeaderException;
use Kartenmacherei\RestFramework\Request\Method\RequestMethod;
use Kartenmacherei\RestFramework\Request\Method\UnsupportedRequestMethodException;
use Kartenmacherei\RestFramework\Request\OptionsRequest;
use Kartenmacherei\RestFramework\Request\PatchRequest;
use Kartenmacherei\RestFramework\Request\PostRequest;
use Kartenmacherei\RestFramework\Request\PutRequest;
use Kartenmacherei\RestFramework\Request\Request;
use Kartenmacherei\RestFramework\Request\UploadedFile\UploadedFilesCollection;
use Kartenmacherei\RestFramework\Request\Uri;
use PHPUnit_Framework_TestCase;

/**
 * @covers \Kartenmacherei\RestFramework\Request\Request
 * @covers \Kartenmacherei\RestFramework\Request\DeleteRequest
 * @covers \Kartenmacherei\RestFramework\Request\GetRequest
 * @covers \Kartenmacherei\RestFramework\Request\PostRequest
 * @covers \Kartenmacherei\RestFramework\Request\Uri
 * @covers \Kartenmacherei\RestFramework\Request\Body\Body
 * @covers \Kartenmacherei\RestFramework\Request\Header\HeaderCollection
 * @covers \Kartenmacherei\RestFramework\Request\UploadedFile\UploadedFilesCollection
 */
class RequestTest extends PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider methodProvider
     *
     * @param string $method
     * @param string $expectedClass
     */
    public function testFromSuperGlobalsCreatesExpectedRequest($method, $expectedClass)
    {
        $_SERVER['REQUEST_URI'] = '/foo';
        $_SERVER['REQUEST_METHOD'] = $method;

        $request = Request::fromSuperGlobals();
        $this->assertInstanceOf($expectedClass, $request);
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
        $request = $this->getAbstractRequest($uri);

        $this->assertSame($uri, $request->getUri());
    }

    public function testProperlyDeterminesIfHeaderExists()
    {
        $uri = new Uri('/foo');
        $request = $this->getAbstractRequest($uri);

        $this->assertTrue($request->hasHeader('TEST_HEADER'));
    }

    public function testProperlyDeterminesIfHeaderDoesNotExist()
    {
        $uri = new Uri('/foo');
        $request = $this->getAbstractRequest($uri, false);

        $this->assertFalse($request->hasHeader('BAD_TEST_HEADER'));
    }

    public function testCanGetHeader()
    {
        $uri = new Uri('/foo');
        $request = $this->getAbstractRequest($uri);

        $this->assertInstanceOf(Header::class, $request->getHeader('TEST_HEADER'));
    }

    public function testThrowsExceptionIfHeaderDoesNotExist()
    {
        $uri = new Uri('/foo');
        $request = $this->getAbstractRequest($uri, false);

        $this->expectException(HeaderException::class);

        $request->getHeader('BAD_TEST_HEADER');
    }

    /**
     * @return array
     */
    public static function methodProvider()
    {
        return [
            [RequestMethod::OPTIONS, OptionsRequest::class],
            [RequestMethod::GET, GetRequest::class],
            [RequestMethod::DELETE, DeleteRequest::class],
            [RequestMethod::PATCH, PatchRequest::class],
            [RequestMethod::POST, PostRequest::class],
            [RequestMethod::PUT, PutRequest::class]
        ];
    }

    /**
     * @param Uri $uri
     * @param bool $hasHeader
     *
     * @return Request|\PHPUnit_Framework_MockObject_MockObject
     */
    private function getAbstractRequest(Uri $uri, bool $hasHeader = true)
    {
        return $this->getMockForAbstractClass(Request::class, [$uri, $this->getHeaderCollectionMock($hasHeader)]);
    }

    /**
     * @param bool $hasHeader
     *
     * @return HeaderCollection|\PHPUnit_Framework_MockObject_MockObject
     */
    private function getHeaderCollectionMock(bool $hasHeader = true)
    {
        $headerCollection = $this->createMock(HeaderCollection::class);
        $headerCollection->method('has')->willReturn($hasHeader);
        if ($hasHeader) {
            $headerCollection->method('get')->willReturn($this->createMock(Header::class));
        } else {
            $headerCollection->method('get')->willThrowException(new HeaderException);
        }
        return $headerCollection;
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject|UploadedFilesCollection
     */
    private function getUploadedFilesCollectionMock()
    {
        return $this->createMock(UploadedFilesCollection::class);
    }
}
