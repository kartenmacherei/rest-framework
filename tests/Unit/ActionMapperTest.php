<?php
namespace Kartenmacherei\RestFramework\UnitTests;

use Kartenmacherei\RestFramework\Action\Command;
use Kartenmacherei\RestFramework\Action\Query;
use Kartenmacherei\RestFramework\ActionMapper;
use Kartenmacherei\RestFramework\Request\Method\DeleteRequestMethod;
use Kartenmacherei\RestFramework\Request\Method\GetRequestMethod;
use Kartenmacherei\RestFramework\Request\Method\PatchRequestMethod;
use Kartenmacherei\RestFramework\Request\Method\PostRequestMethod;
use Kartenmacherei\RestFramework\Request\Method\PutRequestMethod;
use Kartenmacherei\RestFramework\Request\Method\RequestMethod;
use Kartenmacherei\RestFramework\Request\Method\UnsupportedRequestMethodException;
use Kartenmacherei\RestFramework\RestResource\RestResource;
use Kartenmacherei\RestFramework\UnitTests\Stubs\RestResourceStubSupportingAllMethods;
use Kartenmacherei\RestFramework\UnitTests\Stubs\SomeRequestMethod;

/**
 * @covers \Kartenmacherei\RestFramework\ActionMapper
 */
class ActionMapperTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider mapTestDataProvider
     *
     * @param RequestMethod $requestMethod
     * @param string $expectedMethod
     * @param string $actionClassname
     */
    public function testCallsExpectedMethodOnRestResource(RequestMethod $requestMethod, string $expectedMethod, string $actionClassname)
    {
        $resource = $this->getRestResourceMock();
        $action = $this->createMock($actionClassname);

        $resource->method('supports')->willReturn(true);
        $resource->expects($this->once())->method($expectedMethod)->willReturn($action);

        $mapper = new ActionMapper();
        $actualAction = $mapper->getAction($requestMethod, $resource);

        $this->assertSame($action, $actualAction);
    }

    /**
     * @return array
     */
    public static function mapTestDataProvider(): array
    {
        return [
            [new DeleteRequestMethod(), 'getDeleteCommand', Command::class],
            [new GetRequestMethod(), 'getQuery', Query::class],
            [new PatchRequestMethod(), 'getPatchCommand', Command::class],
            [new PostRequestMethod(), 'getPostCommand', Command::class],
            [new PutRequestMethod(), 'getPutCommand', Command::class]
        ];
    }

    /**
     * @dataProvider requestMethodProvider
     *
     * @param RequestMethod $requestMethod
     */
    public function testThrowsExceptionIfMethodIsNotSupported(RequestMethod $requestMethod)
    {
        $resource = $this->getRestResourceMock();
        $mapper = new ActionMapper();

        $this->expectException(UnsupportedRequestMethodException::class);

        $mapper->getAction($requestMethod, $resource);
    }

    public function testThrowsExceptionIfMethodIsUnknown()
    {
        $resource = $this->getRestResourceMock();
        $mapper = new ActionMapper();
        $this->expectException(UnsupportedRequestMethodException::class);

        $mapper->getAction(new SomeRequestMethod(), $resource);
    }

    /**
     * @return array
     */
    public static function requestMethodProvider(): array
    {
        return [
            [new DeleteRequestMethod()],
            [new GetRequestMethod()],
            [new PatchRequestMethod()],
            [new PostRequestMethod()],
            [new PutRequestMethod()]
        ];
    }
    
    /**
     * @return \PHPUnit_Framework_MockObject_MockObject|RestResource
     */
    private function getRestResourceMock()  
    {
        return $this->createMock(RestResourceStubSupportingAllMethods::class);
    }
}
