<?php
namespace Kartenmacherei\RestFramework\UnitTests\ResourceRequest;

use Kartenmacherei\RestFramework\Request\Body\Body;
use Kartenmacherei\RestFramework\Request\Method\RequestMethod;
use Kartenmacherei\RestFramework\Request\Uri;
use Kartenmacherei\RestFramework\ResourceRequest\AbstractResourceRequest;
use PHPUnit_Framework_MockObject_MockObject;
use PHPUnit_Framework_TestCase;

/**
 * @covers \Kartenmacherei\RestFramework\ResourceRequest\AbstractResourceRequest
 */
class AbstractResourceRequestTest extends PHPUnit_Framework_TestCase
{
    public function testGetRequestMethod()
    {
        $requestMethod = $this->getRequestMethodMock();
        $resourceRequest = $this->getAbstractResourceRequest($requestMethod, $this->getUriMock(), $this->getBodyMock());

        $this->assertSame($requestMethod, $resourceRequest->getRequestMethod());
    }

    /**
     * @dataProvider boolProvider
     *
     * @param bool $value
     */
    public function testIsReadRequest(bool $value)
    {
        $requestMethod = $this->getRequestMethodMock();
        $requestMethod->method('equals')->willReturn($value);
        $resourceRequest = $this->getAbstractResourceRequest($requestMethod, $this->getUriMock(), $this->getBodyMock());
        $this->assertSame($value, $resourceRequest->isReadRequest());
    }

    /**
     * @dataProvider boolProvider
     *
     * @param bool $value
     */
    public function testIsOptionsRequest(bool $value)
    {
        $requestMethod = $this->getRequestMethodMock();
        $requestMethod->method('equals')->willReturn($value);
        $resourceRequest = $this->getAbstractResourceRequest($requestMethod, $this->getUriMock(), $this->getBodyMock());
        $this->assertSame($value, $resourceRequest->isOptionsRequest());
    }

    public static function boolProvider()
    {
        return [
            [true],
            [false]
        ];
    }

    /**
     * @param RequestMethod $requestMethod
     * @param Uri $uri
     * @param Body $body
     *
     * @return AbstractResourceRequest|PHPUnit_Framework_MockObject_MockObject
     */
    private function getAbstractResourceRequest(RequestMethod $requestMethod, Uri $uri, Body $body)
    {
        return $this->getMockForAbstractClass(AbstractResourceRequest::class, [$requestMethod, $uri, $body]);
    }

    /**
     * @return PHPUnit_Framework_MockObject_MockObject|RequestMethod
     */
    private function getRequestMethodMock()
    {
        return $this->createMock(RequestMethod::class);
    }

    /**
     * @return PHPUnit_Framework_MockObject_MockObject|Uri
     */
    private function getUriMock()
    {
        return $this->createMock(Uri::class);
    }

    /**
     * @return PHPUnit_Framework_MockObject_MockObject|Body
     */
    private function getBodyMock()
    {
        return $this->createMock(Body::class);
    }

}
