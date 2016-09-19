<?php
namespace Kartenmacherei\RestFramework\UnitTests\Request\Method;

use Kartenmacherei\RestFramework\Request\Method\AbstractRequestMethod;
use Kartenmacherei\RestFramework\Request\Method\GetRequestMethod;
use PHPUnit_Framework_TestCase;

/**
 * @covers \Kartenmacherei\RestFramework\Request\Method\AbstractRequestMethod
 */
class AbstractRequestMethodTest extends PHPUnit_Framework_TestCase
{
    public function testEqualsReturnsTrue()
    {
        $requestMethod = $this->getAbstractRequestMethod();

        $this->assertTrue($requestMethod->equals($this->getAbstractRequestMethod()));
    }

    public function testEqualsReturnsFalse()
    {
        $requestMethod = $this->getAbstractRequestMethod();
        $otherRequestMethod = $this->createMock(GetRequestMethod::class);

        $this->assertFalse($requestMethod->equals($otherRequestMethod));
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject|AbstractRequestMethod
     */
    private function getAbstractRequestMethod()
    {
        return $this->getMockForAbstractClass(AbstractRequestMethod::class);
    }
}
