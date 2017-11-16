<?php
namespace Kartenmacherei\RestFramework\UnitTests\Request\Method;

use Kartenmacherei\RestFramework\Request\Method\AbstractRequestMethod;
use Kartenmacherei\RestFramework\Request\Method\GetRequestMethod;
use PHPUnit\Framework\TestCase;
use PHPUnit_Framework_MockObject_MockObject;

/**
 * @covers \Kartenmacherei\RestFramework\Request\Method\AbstractRequestMethod
 */
class AbstractRequestMethodTest extends TestCase
{
    public function testEqualsReturnsTrue()
    {
        $requestMethod = $this->getAbstractRequestMethod();

        $this->assertTrue($requestMethod->equals($this->getAbstractRequestMethod()));
    }

    public function testEqualsReturnsFalse()
    {
        $requestMethod = $this->getAbstractRequestMethod();
        /** @var GetRequestMethod|PHPUnit_Framework_MockObject_MockObject $otherRequestMethod */
        $otherRequestMethod = $this->createMock(GetRequestMethod::class);

        $this->assertFalse($requestMethod->equals($otherRequestMethod));
    }

    public function testIsOptionsRequest()
    {
        $requestMethod = $this->getAbstractRequestMethod();
        $this->assertFalse($requestMethod->isOptionsMethod());
    }

    /**
     * @return PHPUnit_Framework_MockObject_MockObject|AbstractRequestMethod
     */
    private function getAbstractRequestMethod()
    {
        return $this->getMockForAbstractClass(AbstractRequestMethod::class);
    }
}
