<?php
namespace Kartenmacherei\RestFramework\UnitTests\Router;

use Kartenmacherei\RestFramework\Request\Request;
use Kartenmacherei\RestFramework\ResourceRequest\ResourceRequest;
use Kartenmacherei\RestFramework\Router\AbstractRouter;
use Kartenmacherei\RestFramework\Router\NoMoreRoutersException;
use Kartenmacherei\RestFramework\Router\Router;
use PHPUnit_Framework_MockObject_MockObject;
use PHPUnit_Framework_TestCase;

/**
 * @covers \Kartenmacherei\RestFramework\Router\AbstractRouter
 */
class AbstractRouterTest extends PHPUnit_Framework_TestCase
{

    public function testRouteThrowsException()
    {
        $router = $this->getAbstractRouter();
        $this->expectException(NoMoreRoutersException::class);
        $router->route($this->getRequestMock());
    }

    public function testReturnsResourceRequest()
    {
        $resourceRequest = $this->getResourceRequestMock();

        $router = $this->getAbstractRouter();
        $router->method('canRoute')->willReturn(true);
        $router->method('doRoute')->willReturn($resourceRequest);

        $this->assertSame($resourceRequest, $router->route($this->getRequestMock()));
    }

    public function testHandsRequestToNextRouterAndReturnsResult()
    {
        $resourceRequest = $this->getResourceRequestMock();

        $request = $this->getRequestMock();

        $nextRouter = $this->getRouterMock();
        $nextRouter->expects($this->once())
            ->method('route')
            ->with($request)
            ->willReturn($resourceRequest);

        $router = $this->getAbstractRouter();
        $router->method('canRoute')->willReturn(false);
        $router->setNext($nextRouter);

        $this->assertSame($resourceRequest, $router->route($request));
    }

    /**
     * @return PHPUnit_Framework_MockObject_MockObject|Router
     */
    private function getRouterMock()
    {
        return $this->createMock(Router::class);
    }

    /**
     * @return PHPUnit_Framework_MockObject_MockObject|ResourceRequest
     */
    private function getResourceRequestMock()
    {
        return $this->createMock(ResourceRequest::class);
    }

    /**
     * @return PHPUnit_Framework_MockObject_MockObject|Request
     */
    private function getRequestMock()
    {
        return $this->createMock(Request::class);
    }

    /**
     * @return PHPUnit_Framework_MockObject_MockObject|AbstractRouter
     */
    private function getAbstractRouter()
    {
        return $this->getMockForAbstractClass(AbstractRouter::class);
    }
}
