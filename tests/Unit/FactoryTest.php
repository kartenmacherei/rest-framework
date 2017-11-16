<?php
namespace Kartenmacherei\RestFramework\UnitTests;

use Kartenmacherei\RestFramework\Factory;
use Kartenmacherei\RestFramework\Router\RouterChain;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Kartenmacherei\RestFramework\Factory
 */
class FactoryTest extends TestCase
{
    public function testCreateRouterChain()
    {
        $this->assertInstanceOf(RouterChain::class, (new Factory())->createRouterChain());
    }
}
