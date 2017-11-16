<?php
namespace Kartenmacherei\RestFramework\UnitTests\Request\Method;

use Kartenmacherei\RestFramework\Request\Method\PatchRequestMethod;
use Kartenmacherei\RestFramework\Request\Method\RequestMethod;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Kartenmacherei\RestFramework\Request\Method\PatchRequestMethod
 */
class PatchRequestMethodTest extends TestCase
{
    public function testAsString()
    {
        $requestMethod = new PatchRequestMethod();
        $this->assertSame(RequestMethod::PATCH, $requestMethod->asString());
    }
}
