<?php
namespace Kartenmacherei\RestFramework\UnitTests\Action\Command;

use Kartenmacherei\RestFramework\Action\Command\CommandLocator;
use Kartenmacherei\RestFramework\Action\Command\CommandLocatorChain;
use Kartenmacherei\RestFramework\Action\NoMoreLocatorsException;
use Kartenmacherei\RestFramework\Request\Method\RequestMethod;
use Kartenmacherei\RestFramework\ResourceRequest\ResourceRequest;
use PHPUnit_Framework_MockObject_MockObject;
use PHPUnit_Framework_TestCase;

/**
 * @covers \Kartenmacherei\RestFramework\Action\Command\CommandLocatorChain
 */
class CommandLocatorChainTest extends PHPUnit_Framework_TestCase
{
    public function testGetCommandPassesResourceRequestToFirstInChain()
    {
        $requestMethod = $this->getRequestMethodMock();
        $resourceRequest = $this->getResourceRequestMock();

        $locator = $this->getCommandLocatorMock();
        $locator->expects($this->once())
            ->method('getCommand')
            ->with($requestMethod, $resourceRequest);

        $chain = new CommandLocatorChain();
        $chain->addCommandLocator($locator);

        $chain->getCommand($requestMethod, $resourceRequest);
    }

    public function testAddCommandLocatorSetsNext()
    {
        $locator2 = $this->getCommandLocatorMock();
        $locator2->expects($this->never())->method('setNext');

        $locator1 = $this->getCommandLocatorMock();
        $locator1->expects($this->once())->method('setNext')
            ->with($locator2);

        $chain = new CommandLocatorChain();
        $chain->addCommandLocator($locator1);
        $chain->addCommandLocator($locator2);
    }

    public function testGetCommandThrowsExceptionIfThereAreNoLocators()
    {
        $chain = new CommandLocatorChain();
        $this->expectException(NoMoreLocatorsException::class);
        $chain->getCommand($this->getRequestMethodMock(), $this->getResourceRequestMock());
    }

    /**
     * @return PHPUnit_Framework_MockObject_MockObject|CommandLocator
     */
    private function getCommandLocatorMock()
    {
        return $this->createMock(CommandLocator::class);
    }

    /**
     * @return PHPUnit_Framework_MockObject_MockObject|ResourceRequest
     */
    private function getResourceRequestMock()
    {
        return $this->createMock(ResourceRequest::class);
    }

    /**
     * @return PHPUnit_Framework_MockObject_MockObject|RequestMethod
     */
    private function getRequestMethodMock()
    {
        return $this->createMock(RequestMethod::class);
    }
}
