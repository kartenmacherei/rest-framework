<?php
namespace Kartenmacherei\RestFramework\UnitTests;

use Kartenmacherei\RestFramework\Factory;
use Kartenmacherei\RestFramework\ResourceRequest\ResourceRequestHandler;
use Kartenmacherei\RestFramework\Router\RouterChain;
use PHPUnit_Framework_TestCase;

/**
 * @covers \Kartenmacherei\RestFramework\Factory
 * @covers \Kartenmacherei\RestFramework\ResourceRequest\ResourceRequestHandler
 */
class FactoryTest extends PHPUnit_Framework_TestCase
{
    public function testCreateRouterChain()
    {
        $this->assertInstanceOf(RouterChain::class, (new Factory())->createRouterChain());
    }

    public function testCreateResourceRequestHandler()
    {
        $this->assertInstanceOf(ResourceRequestHandler::class, (new Factory())->createResourceRequestHandler());
    }
}
