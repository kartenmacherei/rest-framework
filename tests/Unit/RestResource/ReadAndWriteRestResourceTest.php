<?php
namespace Kartenmacherei\RestFramework\UnitTests\RestResource;

use Kartenmacherei\RestFramework\Action\Command\CommandLocator;
use Kartenmacherei\RestFramework\Action\Query\QueryLocator;
use Kartenmacherei\RestFramework\RestResource\ReadAndWriteRestResource;
use Kartenmacherei\RestFramework\Router\Router;
use PHPUnit_Framework_MockObject_MockObject;
use PHPUnit_Framework_TestCase;

/**
 * @covers \Kartenmacherei\RestFramework\RestResource\ReadAndWriteRestResource
 */
class ReadAndWriteRestResourceTest extends PHPUnit_Framework_TestCase
{
    public function testHasQueryLocator()
    {
        $resource = new ReadAndWriteRestResource($this->getRouterMock(), $this->getQueryLocatorMock(), $this->getCommandLocatorMock());

        $this->assertTrue($resource->hasQueryLocator());
    }

    public function testGetCommandLocator()
    {
        $commandLocator = $this->getCommandLocatorMock();
        $resource = new ReadAndWriteRestResource($this->getRouterMock(), $this->getQueryLocatorMock(), $commandLocator);

        $this->assertSame($commandLocator, $resource->getCommandLocator());
    }

    public function testGetQueryLocator()
    {
        $queryLocator = $this->getQueryLocatorMock();
        $resource = new ReadAndWriteRestResource($this->getRouterMock(), $queryLocator, $this->getCommandLocatorMock());

        $this->assertSame($queryLocator, $resource->getQueryLocator());
    }

    public function testGetRouter()
    {
        $router = $this->getRouterMock();
        $resource = new ReadAndWriteRestResource($router, $this->getQueryLocatorMock(), $this->getCommandLocatorMock());

        $this->assertSame($router, $resource->getRouter());
    }

    public function testHasCommandLocator()
    {
        $resource = new ReadAndWriteRestResource($this->getRouterMock(), $this->getQueryLocatorMock(), $this->getCommandLocatorMock());
        $this->assertTrue($resource->hasCommandLocator());
    }

    /**
     * @return PHPUnit_Framework_MockObject_MockObject|Router
     */
    private function getRouterMock()
    {
        return $this->createMock(Router::class);
    }

    /**
     * @return PHPUnit_Framework_MockObject_MockObject|QueryLocator
     */
    private function getQueryLocatorMock()
    {
        return $this->createMock(QueryLocator::class);
    }

    /**
     * @return PHPUnit_Framework_MockObject_MockObject|CommandLocator
     */
    private function getCommandLocatorMock()
    {
        return $this->createMock(CommandLocator::class);
    }
}
