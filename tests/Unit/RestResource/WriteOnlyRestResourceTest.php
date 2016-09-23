<?php
namespace Kartenmacherei\RestFramework\UnitTests\RestResource;

use Kartenmacherei\RestFramework\Action\Command\CommandLocator;
use Kartenmacherei\RestFramework\RestResource\WriteOnlyRestResource;
use Kartenmacherei\RestFramework\RestResource\RestResourceException;
use Kartenmacherei\RestFramework\Router\ResourceRouter;
use PHPUnit_Framework_MockObject_MockObject;
use PHPUnit_Framework_TestCase;

/**
 * @covers \Kartenmacherei\RestFramework\RestResource\WriteOnlyRestResource
 */
class WriteOnlyRestResourceTest extends PHPUnit_Framework_TestCase
{
    public function testHasQueryLocator()
    {
        $resource = new WriteOnlyRestResource($this->getRouterMock(), $this->getCommandLocatorMock());

        $this->assertFalse($resource->hasQueryLocator());
    }

    public function testGetCommandLocator()
    {
        $commandLocator = $this->getCommandLocatorMock();
        $resource = new WriteOnlyRestResource($this->getRouterMock(), $commandLocator);

        $this->assertSame($commandLocator, $resource->getCommandLocator());
    }

    public function testGetRouter()
    {
        $router = $this->getRouterMock();
        $resource = new WriteOnlyRestResource($router, $this->getCommandLocatorMock());

        $this->assertSame($router, $resource->getRouter());
    }

    public function testGetQueryLocatorThrowsException()
    {
        $resource = new WriteOnlyRestResource($this->getRouterMock(), $this->getCommandLocatorMock());
        $this->expectException(RestResourceException::class);
        $resource->getQueryLocator();
    }

    public function testHasCommandLocator()
    {
        $resource = new WriteOnlyRestResource($this->getRouterMock(), $this->getCommandLocatorMock());
        $this->assertTrue($resource->hasCommandLocator());
    }

    /**
     * @return PHPUnit_Framework_MockObject_MockObject|ResourceRouter
     */
    private function getRouterMock()
    {
        return $this->createMock(ResourceRouter::class);
    }

    /**
     * @return PHPUnit_Framework_MockObject_MockObject|CommandLocator
     */
    private function getCommandLocatorMock()
    {
        return $this->createMock(CommandLocator::class);
    }
}
