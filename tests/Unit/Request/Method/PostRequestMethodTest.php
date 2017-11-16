<?php
namespace Kartenmacherei\RestFramework\UnitTests\Request\Method;

use Kartenmacherei\RestFramework\Request\Method\PostRequestMethod;
use Kartenmacherei\RestFramework\Request\Method\RequestMethod;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Kartenmacherei\RestFramework\Request\Method\PostRequestMethod
 */
class PostRequestMethodTest extends TestCase
{
    public function testAsString()
    {
        $requestMethod = new PostRequestMethod();
        $this->assertSame(RequestMethod::POST, $requestMethod->asString());
    }
}
