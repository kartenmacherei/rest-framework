<?php
namespace Kartenmacherei\RestFramework\UnitTests\Request\Method;

use Kartenmacherei\RestFramework\Request\Method\GetRequestMethod;
use Kartenmacherei\RestFramework\Request\Method\RequestMethod;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Kartenmacherei\RestFramework\Request\Method\GetRequestMethod
 */
class GetRequestMethodTest extends TestCase
{
    public function testAsString()
    {
        $requestMethod = new GetRequestMethod();
        $this->assertSame(RequestMethod::GET, $requestMethod->asString());
    }
}
