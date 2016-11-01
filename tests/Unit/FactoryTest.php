<?php
namespace Kartenmacherei\RestFramework\UnitTests;

use Kartenmacherei\RestFramework\Factory;
use Kartenmacherei\RestFramework\Router\RouterChain;
use PHPUnit_Framework_TestCase;

/**
 * @covers \Kartenmacherei\RestFramework\Factory
 */
class FactoryTest extends PHPUnit_Framework_TestCase
{
    public function testCreateRouterChain()
    {
        $this->assertInstanceOf(RouterChain::class, (new Factory())->createRouterChain());
    }
}
