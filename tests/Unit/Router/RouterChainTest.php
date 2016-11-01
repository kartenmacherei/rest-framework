<?php
namespace Kartenmacherei\RestFramework\UnitTests\Router;

use Kartenmacherei\RestFramework\Request\Request;
use Kartenmacherei\RestFramework\ResourceRequest\ResourceRequest;
use Kartenmacherei\RestFramework\RestResource\RestResource;
use Kartenmacherei\RestFramework\Router\NoMoreRoutersException;
use Kartenmacherei\RestFramework\Router\ResourceRouter;
use Kartenmacherei\RestFramework\Router\RouterChain;
use PHPUnit_Framework_MockObject_MockObject;
use PHPUnit_Framework_TestCase;

/**
 * @covers \Kartenmacherei\RestFramework\Router\RouterChain
 */
class RouterChainTest extends PHPUnit_Framework_TestCase
{
    public function testThrowsExceptionIfChainIsEmpty()
    {
        $chain = new RouterChain();
        $this->expectException(NoMoreRoutersException::class);
        $chain->route($this->getRequestMock());
    }

    public function testHandsRequestToFirstRouter()
    {
        $resource = $this->getRestResourceMock();

        $request = $this->getRequestMock();
        $router = $this->getRouterMock();
        $router->expects($this->once())
            ->method('route')
            ->with($request)
            ->willReturn($resource);

        $chain = new RouterChain();
        $chain->addRouter($router);

        $this->assertSame($resource, $chain->route($request));
    }

    public function testAddsRouterToPreviousRouterInChain()
    {
        $router2 = $this->getRouterMock();
        $router2->expects($this->never())->method('setNext');
        $router1 = $this->getRouterMock();
        $router1->expects($this->once())->method('setNext')->with($router2);

        $chain = new RouterChain($this->getRequestMock());
        $chain->addRouter($router1);
        $chain->addRouter($router2);
    }

    /**
     * @return PHPUnit_Framework_MockObject_MockObject|ResourceRouter
     */
    private function getRouterMock()
    {
        return $this->createMock(ResourceRouter::class);
    }

    /**
     * @return PHPUnit_Framework_MockObject_MockObject|Request
     */
    private function getRequestMock()
    {
        return $this->createMock(Request::class);
    }

    /**
     * @return PHPUnit_Framework_MockObject_MockObject|RestResource
     */
    private function getRestResourceMock()
    {
        return $this->createMock(RestResource::class);
    }
}
