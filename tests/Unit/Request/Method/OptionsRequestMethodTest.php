<?php
namespace Kartenmacherei\RestFramework\UnitTests\Request\Method;

use Kartenmacherei\RestFramework\Request\Method\OptionsRequestMethod;
use Kartenmacherei\RestFramework\Request\Method\RequestMethod;
use PHPUnit_Framework_TestCase;

/**
 * @covers \Kartenmacherei\RestFramework\Request\Method\OptionsRequestMethod
 */
class OptionsRequestMethodTest extends PHPUnit_Framework_TestCase
{
    public function testAsString()
    {
        $requestMethod = new OptionsRequestMethod();
        $this->assertSame(RequestMethod::OPTIONS, $requestMethod->asString());
    }
}
