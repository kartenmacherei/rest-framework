<?php
namespace Kartenmacherei\RestFramework\UnitTests;

use Kartenmacherei\RestFramework\Action\Command;
use Kartenmacherei\RestFramework\Action\Query;
use Kartenmacherei\RestFramework\ActionMapper;
use Kartenmacherei\RestFramework\Request\DeleteRequest;
use Kartenmacherei\RestFramework\Request\GetRequest;
use Kartenmacherei\RestFramework\Request\Method\DeleteRequestMethod;
use Kartenmacherei\RestFramework\Request\Method\GetRequestMethod;
use Kartenmacherei\RestFramework\Request\Method\PatchRequestMethod;
use Kartenmacherei\RestFramework\Request\Method\PostRequestMethod;
use Kartenmacherei\RestFramework\Request\Method\PutRequestMethod;
use Kartenmacherei\RestFramework\Request\Method\RequestMethod;
use Kartenmacherei\RestFramework\Request\Method\UnsupportedRequestMethodException;
use Kartenmacherei\RestFramework\Request\PatchRequest;
use Kartenmacherei\RestFramework\Request\PostRequest;
use Kartenmacherei\RestFramework\Request\PutRequest;
use Kartenmacherei\RestFramework\RestResource\RestResource;
use Kartenmacherei\RestFramework\UnitTests\Stubs\RestResourceStubSupportingAllMethods;
use Kartenmacherei\RestFramework\UnitTests\Stubs\SomeRequestMethod;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Kartenmacherei\RestFramework\ActionMapper
 */
class ActionMapperTest extends TestCase
{
    /**
     * @dataProvider mapTestDataProvider
     *
     * @param RequestMethod $requestMethod
     * @param string $expectedMethod
     * @param string $actionClassname
     */
    public function testCallsExpectedMethodOnRestResource(RequestMethod $requestMethod, string $expectedMethod, string $actionClassname)
    {
        $resource = $this->getRestResourceMock();
        $action = $this->createMock($actionClassname);

        $resource->method('supports')->willReturn(true);
        $resource->expects($this->once())->method($expectedMethod)->willReturn($action);

        $request = $this->getRequestMock($requestMethod);
        $request->method('getMethod')->willReturn($requestMethod);

        $mapper = new ActionMapper();
        $actualAction = $mapper->getAction($request, $resource);

        $this->assertSame($action, $actualAction);
    }

    /**
     * @param RequestMethod $requestMethod
     * 
     * @return \PHPUnit_Framework_MockObject_MockObject|PatchRequest
     */
    private function getRequestMock(RequestMethod $requestMethod)
    {
        switch (true)
        {
            case $requestMethod instanceof PatchRequestMethod:
                return $this->getPatchRequestMock();
            case $requestMethod instanceof GetRequestMethod:
                return $this->getGetRequestMock();
            case $requestMethod instanceof PutRequestMethod:
                return $this->getPutRequestMock();
            case $requestMethod instanceof DeleteRequestMethod:
                return $this->getDeleteRequestMock();
            case $requestMethod instanceof PostRequestMethod:
                return $this->getPostRequestMock();
        }
        throw new \RuntimeException('Invalid Request Method');
    }
    
    /**
     * @return array
     */
    public static function mapTestDataProvider(): array
    {
        return [
            [new DeleteRequestMethod(), 'getDeleteCommand', Command::class],
            [new GetRequestMethod(), 'getQuery', Query::class],
            [new PatchRequestMethod(), 'getPatchCommand', Command::class],
            [new PostRequestMethod(), 'getPostCommand', Command::class],
            [new PutRequestMethod(), 'getPutCommand', Command::class]
        ];
    }

    /**
     * @dataProvider requestMethodProvider
     *
     * @param RequestMethod $requestMethod
     */
    public function testThrowsExceptionIfMethodIsNotSupported(RequestMethod $requestMethod)
    {
        $resource = $this->getRestResourceMock();
        $mapper = new ActionMapper();

        $request = $this->getRequestMock($requestMethod);
        $request->method('getMethod')->willReturn($requestMethod);

        $this->expectException(UnsupportedRequestMethodException::class);

        $mapper->getAction($request, $resource);
    }

    public function testThrowsExceptionIfMethodIsUnknown()
    {
        $resource = $this->getRestResourceMock();
        $mapper = new ActionMapper();
        $this->expectException(UnsupportedRequestMethodException::class);

        $request = $this->getGetRequestMock();
        $request->method('getMethod')->willReturn(new SomeRequestMethod());


        $mapper->getAction($request, $resource);
    }

    /**
     * @return array
     */
    public static function requestMethodProvider(): array
    {
        return [
            [new DeleteRequestMethod()],
            [new GetRequestMethod()],
            [new PatchRequestMethod()],
            [new PostRequestMethod()],
            [new PutRequestMethod()]
        ];
    }
    
    /**
     * @return \PHPUnit_Framework_MockObject_MockObject|RestResource
     */
    private function getRestResourceMock()  
    {
        return $this->createMock(RestResourceStubSupportingAllMethods::class);
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject|GetRequest
     */
    private function getGetRequestMock()
    {
        return $this->createMock(GetRequest::class);
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject|DeleteRequest
     */
    private function getDeleteRequestMock()
    {
        return $this->createMock(DeleteRequest::class);
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject|PostRequest
     */
    private function getPostRequestMock()
    {
        return $this->createMock(PostRequest::class);
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject|PutRequest
     */
    private function getPutRequestMock()
    {
        return $this->createMock(PutRequest::class);
    }
    
    /**
     * @return \PHPUnit_Framework_MockObject_MockObject|PatchRequest
     */
    private function getPatchRequestMock()
    {
        return $this->createMock(PatchRequest::class);
    }
}
