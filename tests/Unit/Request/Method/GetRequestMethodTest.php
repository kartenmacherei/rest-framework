<?php
namespace Kartenmacherei\RestFramework\UnitTests\Request\Method;

use Kartenmacherei\RestFramework\Request\Method\GetRequestMethod;
use Kartenmacherei\RestFramework\Request\Method\RequestMethod;
use PHPUnit_Framework_TestCase;

/**
 * @covers \Kartenmacherei\RestFramework\Request\Method\GetRequestMethod
 */
class GetRequestMethodTest extends PHPUnit_Framework_TestCase
{
    public function testAsString()
    {
        $requestMethod = new GetRequestMethod();
        $this->assertSame(RequestMethod::GET, $requestMethod->asString());
    }
}
