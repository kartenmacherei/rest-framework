<?php
namespace Kartenmacherei\RestFramework\UnitTests\Request\Method;

use Kartenmacherei\RestFramework\Request\Method\OptionsRequestMethod;
use Kartenmacherei\RestFramework\Request\Method\RequestMethod;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Kartenmacherei\RestFramework\Request\Method\OptionsRequestMethod
 */
class OptionsRequestMethodTest extends TestCase
{
    public function testAsString()
    {
        $requestMethod = new OptionsRequestMethod();
        $this->assertSame(RequestMethod::OPTIONS, $requestMethod->asString());
    }

    public function testIsOptionsMethod()
    {
        $method = new OptionsRequestMethod();
        $this->assertTrue($method->isOptionsMethod());
    }
}
