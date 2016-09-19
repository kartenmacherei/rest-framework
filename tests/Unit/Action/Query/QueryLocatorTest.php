<?php
namespace Kartenmacherei\RestFramework\UnitTests\Action\Query;

use Kartenmacherei\RestFramework\Action\Query\QueryLocator;
use Kartenmacherei\RestFramework\Action\Query\QueryLocatorChain;
use Kartenmacherei\RestFramework\Action\NoMoreLocatorsException;
use Kartenmacherei\RestFramework\ResourceRequest\ResourceRequest;
use PHPUnit_Framework_MockObject_MockObject;
use PHPUnit_Framework_TestCase;

/**
 * @covers \Kartenmacherei\RestFramework\Action\Query\QueryLocatorChain
 */
class QueryLocatorChainTest extends PHPUnit_Framework_TestCase
{
    public function testGetQueryPassesResourceRequestToFirstInChain()
    {
        $resourceRequest = $this->getResourceRequestMock();

        $locator = $this->getQueryLocatorMock();
        $locator->expects($this->once())
            ->method('getQuery')
            ->with($resourceRequest);

        $chain = new QueryLocatorChain();
        $chain->addQueryLocator($locator);

        $chain->getQuery($resourceRequest);
    }

    public function testAddQueryLocatorSetsNext()
    {
        $locator2 = $this->getQueryLocatorMock();
        $locator2->expects($this->never())->method('setNext');

        $locator1 = $this->getQueryLocatorMock();
        $locator1->expects($this->once())->method('setNext')
            ->with($locator2);

        $chain = new QueryLocatorChain();
        $chain->addQueryLocator($locator1);
        $chain->addQueryLocator($locator2);
    }

    public function testGetQueryThrowsExceptionIfThereAreNoLocators()
    {
        $chain = new QueryLocatorChain();
        $this->expectException(NoMoreLocatorsException::class);
        $chain->getQuery($this->getResourceRequestMock());
    }

    /**
     * @return PHPUnit_Framework_MockObject_MockObject|QueryLocator
     */
    private function getQueryLocatorMock()
    {
        return $this->createMock(QueryLocator::class);
    }

    /**
     * @return PHPUnit_Framework_MockObject_MockObject|ResourceRequest
     */
    private function getResourceRequestMock()
    {
        return $this->createMock(ResourceRequest::class);
    }
}
