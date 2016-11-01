<?php
namespace Kartenmacherei\RestFramework\UnitTests;

use Kartenmacherei\RestFramework\Action\Action;
use Kartenmacherei\RestFramework\Framework;
use Kartenmacherei\RestFramework\Request\Request;
use Kartenmacherei\RestFramework\ResourceRequest\ResourceRequest;
use Kartenmacherei\RestFramework\Response\MethodNotAllowedResponse;
use Kartenmacherei\RestFramework\Response\NotFoundResponse;
use Kartenmacherei\RestFramework\Response\Response;
use Kartenmacherei\RestFramework\RestResource\RestResource;
use Kartenmacherei\RestFramework\Router\NoMoreRoutersException;
use Kartenmacherei\RestFramework\Router\ResourceRouter;
use Kartenmacherei\RestFramework\Router\RouterChain;

/**
 * @covers \Kartenmacherei\RestFramework\Framework
 * @covers \Kartenmacherei\RestFramework\Factory
 */
class FrameworkTest extends \PHPUnit_Framework_TestCase
{
    public function testCreateInstanceReturnsExpectedObject()
    {
        $this->assertInstanceOf(Framework::class, Framework::createInstance());
    }

    public function testReturnsNotFoundResponseWhenNoMoreRoutersExceptionIsThrown()
    {
        $routerChain = $this->getRouterChainMock();
        $routerChain->method('route')->willThrowException(new NoMoreRoutersException());
        $framework = new Framework($routerChain);

        $this->assertInstanceOf(NotFoundResponse::class, $framework->run($this->getRequestMock()));
    }
    
    public function testRegisterResourceAddsRouter()
    {
        $router = $this->getRouterMock();

        $routerChain = $this->getRouterChainMock();
        $routerChain->expects($this->once())->method('addRouter')->with($this->identicalTo($router));

        $framework = new Framework($routerChain);

        $framework->registerResourceRouter($router);
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject|Action
     */
    private function getActionMock()
    {
        return $this->createMock(Action::class);
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject|RestResource
     */
    private function getRestResourceMock()
    {
        return $this->createMock(RestResource::class);
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject|ResourceRouter
     */
    private function getRouterMock()
    {
        return $this->createMock(ResourceRouter::class);
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject|Resource
     */
    private function getResponseMock()
    {
        return $this->createMock(Response::class);
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject|ResourceRequest
     */
    private function getResourceRequestMock()
    {
        return $this->createMock(ResourceRequest::class);
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject|RouterChain
     */
    private function getRouterChainMock()
    {
        return $this->createMock(RouterChain::class);
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject|Request
     */
    private function getRequestMock()
    {
        return $this->createMock(Request::class);
    }
}
