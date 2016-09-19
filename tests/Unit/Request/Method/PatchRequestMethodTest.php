<?php
namespace Kartenmacherei\RestFramework\UnitTests\Request\Method;

use Kartenmacherei\RestFramework\Request\Method\PatchRequestMethod;
use Kartenmacherei\RestFramework\Request\Method\RequestMethod;
use PHPUnit_Framework_TestCase;

/**
 * @covers \Kartenmacherei\RestFramework\Request\Method\PatchRequestMethod
 */
class PatchRequestMethodTest extends PHPUnit_Framework_TestCase
{
    public function testAsString()
    {
        $requestMethod = new PatchRequestMethod();
        $this->assertSame(RequestMethod::PATCH, $requestMethod->asString());
    }
}
