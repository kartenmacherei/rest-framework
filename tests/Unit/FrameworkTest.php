<?php
namespace Kartenmacherei\RestFramework\UnitTests;

use Kartenmacherei\RestFramework\Action\Command\CommandLocator;
use Kartenmacherei\RestFramework\Action\NoMoreLocatorsException;
use Kartenmacherei\RestFramework\Action\Query\QueryLocator;
use Kartenmacherei\RestFramework\Framework;
use Kartenmacherei\RestFramework\Request\Request;
use Kartenmacherei\RestFramework\ResourceRequest\ResourceRequest;
use Kartenmacherei\RestFramework\ResourceRequest\ResourceRequestHandler;
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
 * @covers \Kartenmacherei\RestFramework\ResourceRequest\ResourceRequestHandler
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

    public function testReturnsMethodNotAllowedResponseWhenNoMoreLocatorsExceptionIsThrown()
    {
        $routerChain = $this->getRouterChainMock();
        $routerChain->method('route')->willReturn($this->getResourceRequestMock());

        $requestHandler = $this->getResourceRequestHandlerMock();
        $requestHandler->method('handle')->willThrowException(new NoMoreLocatorsException());

        $framework = new Framework($routerChain);

        $this->assertInstanceOf(MethodNotAllowedResponse::class, $framework->run($this->getRequestMock()));
    }

    public function testReturnsResponseFromResourceHandler()
    {
        $routerChain = $this->getRouterChainMock();
        $routerChain->method('route')->willReturn($this->getResourceRequestMock());

        $response = $this->getResponseMock();

        $requestHandler = $this->getResourceRequestHandlerMock();
        $requestHandler->method('handle')->willReturn($response);

        $framework = new Framework($routerChain);

        $this->assertSame($response, $framework->run($this->getRequestMock()));
    }

    public function testRegisterResourceAddsRouter()
    {
        $router = $this->getRouterMock();
        $restResource = $this->getRestResourceMock();
        $restResource->method('getRouter')->willReturn($router);

        $routerChain = $this->getRouterChainMock();
        $routerChain->expects($this->once())->method('addRouter')->with($this->identicalTo($router));

        $framework = new Framework($routerChain);

        $framework->registerResourceRouter($restResource);
    }

    public function testRegisterResourceAddsCommandLocator()
    {
        $commandLocator = $this->getCommandLocatorMock();

        $restResource = $this->getRestResourceMock();
        $restResource->method('hasCommandLocator')->willReturn(true);
        $restResource->method('getCommandLocator')->willReturn($commandLocator);

        $requestHandler = $this->getResourceRequestHandlerMock();
        $requestHandler->expects($this->once())->method('registerCommandLocator')->with($this->identicalTo($commandLocator));

        $framework = new Framework($this->getRouterChainMock());

        $framework->registerResourceRouter($restResource);
    }    
    
    public function testRegisterResourceAddsQueryLocator()
    {
        $queryLocator = $this->getQueryLocatorMock();

        $restResource = $this->getRestResourceMock();
        $restResource->method('hasQueryLocator')->willReturn(true);
        $restResource->method('getQueryLocator')->willReturn($queryLocator);

        $requestHandler = $this->getResourceRequestHandlerMock();
        $requestHandler->expects($this->once())->method('registerQueryLocator')->with($this->identicalTo($queryLocator));

        $framework = new Framework($this->getRouterChainMock());

        $framework->registerResourceRouter($restResource);
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject|CommandLocator
     */
    private function getCommandLocatorMock()
    {
        return $this->createMock(CommandLocator::class);
    }    
    
    /**
     * @return \PHPUnit_Framework_MockObject_MockObject|QueryLocator
     */
    private function getQueryLocatorMock()
    {
        return $this->createMock(QueryLocator::class);
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
     * @return \PHPUnit_Framework_MockObject_MockObject|ResourceRequestHandler
     */
    private function getResourceRequestHandlerMock()
    {
        return $this->createMock(ResourceRequestHandler::class);
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
