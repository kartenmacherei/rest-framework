<?php
namespace Kartenmacherei\RestFramework\UnitTests\Request\Method;

use Kartenmacherei\RestFramework\Request\Method\DeleteRequestMethod;
use Kartenmacherei\RestFramework\Request\Method\RequestMethod;
use PHPUnit_Framework_TestCase;

/**
 * @covers \Kartenmacherei\RestFramework\Request\Method\DeleteRequestMethod
 */
class DeleteRequestMethodTest extends PHPUnit_Framework_TestCase
{
    public function testAsString()
    {
        $requestMethod = new DeleteRequestMethod();
        $this->assertSame(RequestMethod::DELETE, $requestMethod->asString());
    }
}
