<?php
namespace Kartenmacherei\RestFramework\UnitTests\Request\Method;

use Kartenmacherei\RestFramework\Request\Method\DeleteRequestMethod;
use Kartenmacherei\RestFramework\Request\Method\RequestMethod;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Kartenmacherei\RestFramework\Request\Method\DeleteRequestMethod
 */
class DeleteRequestMethodTest extends TestCase
{
    public function testAsString()
    {
        $requestMethod = new DeleteRequestMethod();
        $this->assertSame(RequestMethod::DELETE, $requestMethod->asString());
    }
}
