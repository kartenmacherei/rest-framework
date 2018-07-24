<?php
namespace Kartenmacherei\RestFramework\UnitTests;

use Kartenmacherei\RestFramework\Action\Action;
use Kartenmacherei\RestFramework\ActionMapper;
use Kartenmacherei\RestFramework\Config;
use Kartenmacherei\RestFramework\Framework;
use Kartenmacherei\RestFramework\Monitoring\TransactionMonitoring;
use Kartenmacherei\RestFramework\Monitoring\TransactionNameMapper;
use Kartenmacherei\RestFramework\Request\Method\GetRequestMethod;
use Kartenmacherei\RestFramework\Request\Method\PostRequestMethod;
use Kartenmacherei\RestFramework\Request\Request;
use Kartenmacherei\RestFramework\Request\UnauthorizedException;
use Kartenmacherei\RestFramework\ResourceRequest\BadRequestException;
use Kartenmacherei\RestFramework\Response\BadRequestResponse;
use Kartenmacherei\RestFramework\Response\NotFoundResponse;
use Kartenmacherei\RestFramework\Response\OptionsResponse;
use Kartenmacherei\RestFramework\Response\Response;
use Kartenmacherei\RestFramework\Response\UnauthorizedResponse;
use Kartenmacherei\RestFramework\RestResource\RestResource;
use Kartenmacherei\RestFramework\Router\NoMoreRoutersException;
use Kartenmacherei\RestFramework\Router\ResourceRouter;
use Kartenmacherei\RestFramework\Router\RouterChain;
use PHPUnit\Framework\TestCase;
use PHPUnit_Framework_MockObject_MockObject;

/**
 * @covers \Kartenmacherei\RestFramework\Framework
 * @uses \Kartenmacherei\RestFramework\Factory
 * @uses \Kartenmacherei\RestFramework\Response\BadRequestResponse
 * @uses \Kartenmacherei\RestFramework\Response\OptionsResponse
 */
class FrameworkTest extends TestCase
{
    /**
     * @var Framework
     */
    private $framework;

    /**
     * @var RouterChain|PHPUnit_Framework_MockObject_MockObject
     */
    private $routerChainMock;

    /**
     * @var ActionMapper|PHPUnit_Framework_MockObject_MockObject
     */
    private $actionMapperMock;

    /**
     * @var TransactionMonitoring|PHPUnit_Framework_MockObject_MockObject
     */
    private $transactionMonitoring;

    /**
     * @var TransactionNameMapper|PHPUnit_Framework_MockObject_MockObject
     */
    private $transactionNameMapperMock;

    protected function setUp()
    {
        parent::setUp();

        $this->routerChainMock = $this->getRouterChainMock();
        $this->actionMapperMock = $this->getActionMapperMock();
        $this->transactionMonitoring = $this->getTransactionMonitoringMock();
        $this->transactionNameMapperMock = $this->getTransactionNameMapperMock();

        $this->framework = new Framework(
            $this->routerChainMock,
            $this->actionMapperMock,
            $this->transactionMonitoring,
            $this->transactionNameMapperMock
        );
    }

    public function testCreateInstanceReturnsExpectedObject()
    {
        $this->assertInstanceOf(Framework::class, Framework::createInstance($this->getConfigMock()));
    }

    public function testReturnsNotFoundResponseWhenNoMoreRoutersExceptionIsThrown()
    {
        $this->routerChainMock->method('route')->willThrowException(new NoMoreRoutersException());

        $this->assertInstanceOf(NotFoundResponse::class, $this->framework->run($this->getRequestMock()));
    }

    public function testReturnsUnauthorizedResponseWhenUnauthorizedExceptionIsThrown()
    {
        $this->routerChainMock->method('route')->willThrowException(new UnauthorizedException());

        $this->assertInstanceOf(UnauthorizedResponse::class, $this->framework->run($this->getRequestMock()));
    }

    public function testReturnsBadRequestResponseIfBadRequestExceptionIsThrown()
    {
        $resource = $this->getRestResourceMock();

        $this->routerChainMock->method('route')->willReturn($resource);
        $this->actionMapperMock->method('getAction')->willThrowException(new BadRequestException());

        $this->assertInstanceOf(BadRequestResponse::class, $this->framework->run($this->getRequestMock()));
    }

    public function testRegisterResourceRouterAddsRouter()
    {
        $router = $this->getRouterMock();

        $this->routerChainMock->expects($this->once())->method('addRouter')->with($this->identicalTo($router));

        $this->framework->registerResourceRouter($router);
    }

    public function testReturnsOptionsResponse()
    {
        $supportedMethods = [new GetRequestMethod(), new PostRequestMethod()];

        $resource = $this->getRestResourceMock();
        $resource->method('getSupportedMethods')->willReturn($supportedMethods);
        $this->routerChainMock->method('route')->willReturn($resource);

        $request = $this->getRequestMock();
        $request->method('isOptionsRequest')->willReturn(true);

        $expectedResponse = new OptionsResponse($supportedMethods);
        $this->assertEquals($expectedResponse, $this->framework->run($request));
    }

    public function testReturnsExpectedResponseFromAction()
    {
        $resource = $this->getRestResourceMock();
        $response = $this->getResponseMock();

        $action = $this->getActionMock();
        $action->method('execute')->willReturn($response);

        $this->routerChainMock->method('route')->willReturn($resource);
        $this->actionMapperMock->method('getAction')->willReturn($action);

        $this->assertSame($response, $this->framework->run($this->getRequestMock()));
    }

    /**
     * @return PHPUnit_Framework_MockObject_MockObject|Action
     */
    private function getActionMock()
    {
        return $this->createMock(Action::class);
    }

    /**
     * @return PHPUnit_Framework_MockObject_MockObject|RestResource
     */
    private function getRestResourceMock()
    {
        return $this->createMock(RestResource::class);
    }

    /**
     * @return PHPUnit_Framework_MockObject_MockObject|ResourceRouter
     */
    private function getRouterMock()
    {
        return $this->createMock(ResourceRouter::class);
    }

    /**
     * @return PHPUnit_Framework_MockObject_MockObject|Resource
     */
    private function getResponseMock()
    {
        return $this->createMock(Response::class);
    }

    /**
     * @return PHPUnit_Framework_MockObject_MockObject|RouterChain
     */
    private function getRouterChainMock()
    {
        return $this->createMock(RouterChain::class);
    }

    /**
     * @return PHPUnit_Framework_MockObject_MockObject|Request
     */
    private function getRequestMock()
    {
        return $this->createMock(Request::class);
    }

    /**
     * @return PHPUnit_Framework_MockObject_MockObject|ActionMapper
     */
    private function getActionMapperMock()
    {
        return $this->createMock(ActionMapper::class);
    }

    /**
     * @return PHPUnit_Framework_MockObject_MockObject|Config
     */
    private function getConfigMock()
    {
        return $this->createMock(Config::class);
    }

    /**
     * @return PHPUnit_Framework_MockObject_MockObject|TransactionMonitoring
     */
    private function getTransactionMonitoringMock()
    {
        return $this->createMock(TransactionMonitoring::class);
    }

    /**
     * @return PHPUnit_Framework_MockObject_MockObject|TransactionNameMapper
     */
    private function getTransactionNameMapperMock()
    {
        return $this->createMock(TransactionNameMapper::class);
    }
}
