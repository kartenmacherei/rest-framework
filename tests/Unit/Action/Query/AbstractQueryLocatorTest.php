<?php
namespace Kartenmacherei\RestFramework\UnitTests\Action\Query;

use Kartenmacherei\RestFramework\Action\NoMoreLocatorsException;
use Kartenmacherei\RestFramework\Action\Query\AbstractQueryLocator;
use Kartenmacherei\RestFramework\Action\Query\Query;
use Kartenmacherei\RestFramework\Action\Query\QueryLocator;
use Kartenmacherei\RestFramework\ResourceRequest\ResourceRequest;
use PHPUnit_Framework_MockObject_MockObject;
use PHPUnit_Framework_TestCase;

/**
 * @covers \Kartenmacherei\RestFramework\Action\Query\AbstractQueryLocator
 */
class AbstractQueryLocatorTest extends PHPUnit_Framework_TestCase
{
    public function testThrowsNoMoreLocatorsException()
    {
        $locator = $this->getAbstractQueryLocator();
        $this->expectException(NoMoreLocatorsException::class);
        $locator->getQuery($this->getResourceRequestMock());
    }

    public function testHandsResourceRequestToNextLocatorAndReturnsTheResult()
    {
        $query = $this->getQueryMock();

        $nextLocator = $this->getQueryLocatorMock();
        $nextLocator->expects($this->once())
            ->method('getQuery')
            ->willReturn($query);

        $resourceRequest = $this->getResourceRequestMock();

        $locator = $this->getAbstractQueryLocator();
        $locator->setNext($nextLocator);
        $locator->method('matches')->willReturn(false);

        $this->assertSame($query, $locator->getQuery($resourceRequest));
    }

    public function testReturnsQueryIfMatches()
    {
        $resourceRequest = $this->getResourceRequestMock();

        $query = $this->getQueryMock();

        $locator = $this->getAbstractQueryLocator();
        $locator->method('matches')->willReturn(true);
        $locator->method('buildQuery')->with($resourceRequest)->willReturn($query);
        $this->assertSame($query, $locator->getQuery($resourceRequest));
    }

    /**
     * @return PHPUnit_Framework_MockObject_MockObject|QueryLocator
     */
    private function getQueryLocatorMock()
    {
        return $this->createMock(QueryLocator::class);
    }

    /**
     * @return PHPUnit_Framework_MockObject_MockObject|Query
     */
    private function getQueryMock()
    {
        return $this->createMock(Query::class);
    }

    /**
     * @return PHPUnit_Framework_MockObject_MockObject|ResourceRequest
     */
    private function getResourceRequestMock()
    {
        return $this->createMock(ResourceRequest::class);
    }

    /**
     * @return PHPUnit_Framework_MockObject_MockObject|AbstractQueryLocator
     */
    private function getAbstractQueryLocator()
    {
        return $this->getMockForAbstractClass(AbstractQueryLocator::class);
    }
}
