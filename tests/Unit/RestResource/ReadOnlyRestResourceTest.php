<?php
namespace Kartenmacherei\RestFramework\UnitTests\RestResource;

use Kartenmacherei\RestFramework\Action\Query\QueryLocator;
use Kartenmacherei\RestFramework\RestResource\ReadOnlyRestResource;
use Kartenmacherei\RestFramework\RestResource\RestResourceException;
use Kartenmacherei\RestFramework\Router\ResourceRouter;
use PHPUnit_Framework_MockObject_MockObject;
use PHPUnit_Framework_TestCase;

/**
 * @covers \Kartenmacherei\RestFramework\RestResource\ReadOnlyRestResource
 */
class ReadOnlyRestResourceTest extends PHPUnit_Framework_TestCase
{
    public function testHasQueryLocator()
    {
        $resource = new ReadOnlyRestResource($this->getRouterMock(), $this->getQueryLocatorMock());

        $this->assertTrue($resource->hasQueryLocator());
    }

    public function testGetQueryLocator()
    {
        $queryLocator = $this->getQueryLocatorMock();
        $resource = new ReadOnlyRestResource($this->getRouterMock(), $queryLocator);

        $this->assertSame($queryLocator, $resource->getQueryLocator());
    }

    public function testGetRouter()
    {
        $router = $this->getRouterMock();
        $resource = new ReadOnlyRestResource($router, $this->getQueryLocatorMock());

        $this->assertSame($router, $resource->getRouter());
    }

    public function testGetCommandLocatorThrowsException()
    {
        $resource = new ReadOnlyRestResource($this->getRouterMock(), $this->getQueryLocatorMock());
        $this->expectException(RestResourceException::class);
        $resource->getCommandLocator();
    }

    public function testHasCommandLocator()
    {
        $resource = new ReadOnlyRestResource($this->getRouterMock(), $this->getQueryLocatorMock());
        $this->assertFalse($resource->hasCommandLocator());
    }

    /**
     * @return PHPUnit_Framework_MockObject_MockObject|ResourceRouter
     */
    private function getRouterMock()
    {
        return $this->createMock(ResourceRouter::class);
    }

    /**
     * @return PHPUnit_Framework_MockObject_MockObject|QueryLocator
     */
    private function getQueryLocatorMock()
    {
        return $this->createMock(QueryLocator::class);
    }
}
