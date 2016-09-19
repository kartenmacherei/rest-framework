<?php
namespace Kartenmacherei\RestFramework\UnitTests\ResourceRequest;

use Kartenmacherei\RestFramework\Action\Command\Command;
use Kartenmacherei\RestFramework\Action\Command\CommandLocator;
use Kartenmacherei\RestFramework\Action\Command\CommandLocatorChain;
use Kartenmacherei\RestFramework\Action\Query\Query;
use Kartenmacherei\RestFramework\Action\Query\QueryLocator;
use Kartenmacherei\RestFramework\Action\Query\QueryLocatorChain;
use Kartenmacherei\RestFramework\Request\Method\GetRequestMethod;
use Kartenmacherei\RestFramework\Request\Method\PutRequestMethod;
use Kartenmacherei\RestFramework\ResourceRequest\ResourceRequest;
use Kartenmacherei\RestFramework\ResourceRequest\ResourceRequestHandler;
use Kartenmacherei\RestFramework\Response\OptionsResponse;
use PHPUnit_Framework_MockObject_MockObject;
use PHPUnit_Framework_TestCase;

/**
 * @covers \Kartenmacherei\RestFramework\ResourceRequest\ResourceRequestHandler
 * @covers \Kartenmacherei\RestFramework\Response\OptionsResponse
 */
class ResourceRequestHandlerTest extends PHPUnit_Framework_TestCase
{
    public function testRegistersQueryLocator()
    {
        $queryLocator = $this->getQueryLocatorMock();

        $queryLocatorChain = $this->getQueryLocatorChainMock();
        $queryLocatorChain->expects($this->once())
            ->method('addQueryLocator')
            ->with($queryLocator);

        $handler = new ResourceRequestHandler(
            $this->getCommandLocatorChainMock(), $queryLocatorChain
        );

        $handler->registerQueryLocator($queryLocator);
    }

    public function testRegistersCommandLocator()
    {
        $commandLocator = $this->getCommandLocatorMock();

        $commandLocatorChain = $this->getCommandLocatorChainMock();
        $commandLocatorChain->expects($this->once())
            ->method('addCommandLocator')
            ->with($commandLocator);

        $handler = new ResourceRequestHandler(
            $commandLocatorChain, $this->getQueryLocatorChainMock()
        );

        $handler->registerCommandLocator($commandLocator);
    }

    public function testHandlesOptionsRequest()
    {
        $supportedMethods = [new GetRequestMethod(), new PutRequestMethod()];

        $resourceRequest = $this->getResourceRequestMock();
        $resourceRequest->method('isOptionsRequest')->willReturn(true);
        $resourceRequest->method('getSupportedMethods')
            ->willReturn($supportedMethods);

        $handler = new ResourceRequestHandler(
            $this->getCommandLocatorChainMock(), $this->getQueryLocatorChainMock()
        );

        $expected = new OptionsResponse($supportedMethods);
        $actual = $handler->handle($resourceRequest);

        $this->assertEquals($expected, $actual);
    }

    public function testHandlesReadRequest()
    {
        $resourceRequest = $this->getResourceRequestMock();
        $resourceRequest->method('isOptionsRequest')->willReturn(false);
        $resourceRequest->method('isReadRequest')->willReturn(true);

        $query = $this->getQueryMock();
        $query->expects($this->once())->method('execute');

        $queryLocatorChain = $this->getQueryLocatorChainMock();
        $queryLocatorChain->method('getQuery')->willReturn($query);

        $handler = new ResourceRequestHandler(
            $this->getCommandLocatorChainMock(), $queryLocatorChain
        );

        $handler->handle($resourceRequest);
    }

    public function testHandlesWriteRequest()
    {
        $resourceRequest = $this->getResourceRequestMock();
        $resourceRequest->method('isOptionsRequest')->willReturn(false);
        $resourceRequest->method('isReadRequest')->willReturn(false);

        $commmand = $this->getCommandMock();
        $commmand->expects($this->once())->method('execute');

        $commandLocatorChain = $this->getCommandLocatorChainMock();
        $commandLocatorChain->method('getCommand')->willReturn($commmand);

        $handler = new ResourceRequestHandler(
            $commandLocatorChain, $this->getQueryLocatorChainMock()
        );

        $handler->handle($resourceRequest);
    }

    /**
     * @return PHPUnit_Framework_MockObject_MockObject|Query
     */
    private function getQueryMock()
    {
        return $this->createMock(Query::class);
    }

    /**
     * @return PHPUnit_Framework_MockObject_MockObject|Command
     */
    private function getCommandMock()
    {
        return $this->createMock(Command::class);
    }

    /**
     * @return PHPUnit_Framework_MockObject_MockObject|ResourceRequest
     */
    private function getResourceRequestMock()
    {
        return $this->createMock(ResourceRequest::class);
    }

    /**
     * @return PHPUnit_Framework_MockObject_MockObject|CommandLocatorChain
     */
    private function getCommandLocatorChainMock()
    {
        return $this->createMock(CommandLocatorChain::class);
    }
    
    /**
     * @return PHPUnit_Framework_MockObject_MockObject|QueryLocatorChain
     */
    private function getQueryLocatorChainMock()
    {
        return $this->createMock(QueryLocatorChain::class);
    }

    /**
     * @return PHPUnit_Framework_MockObject_MockObject|CommandLocator
     */
    private function getCommandLocatorMock()
    {
        return $this->createMock(CommandLocator::class);
    }    
    
    /**
     * @return PHPUnit_Framework_MockObject_MockObject|QueryLocator
     */
    private function getQueryLocatorMock()
    {
        return $this->createMock(QueryLocator::class);
    }
}
