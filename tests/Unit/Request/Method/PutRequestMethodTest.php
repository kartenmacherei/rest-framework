<?php
namespace Kartenmacherei\RestFramework\UnitTests\Request\Method;

use Kartenmacherei\RestFramework\Request\Method\PutRequestMethod;
use Kartenmacherei\RestFramework\Request\Method\RequestMethod;
use PHPUnit_Framework_TestCase;

/**
 * @covers \Kartenmacherei\RestFramework\Request\Method\PutRequestMethod
 */
class PutRequestMethodTest extends PHPUnit_Framework_TestCase
{
    public function testAsString()
    {
        $requestMethod = new PutRequestMethod();
        $this->assertSame(RequestMethod::PUT, $requestMethod->asString());
    }
}
