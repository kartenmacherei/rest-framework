<?php
namespace Kartenmacherei\RestFramework\UnitTests\RestResource;

use Kartenmacherei\RestFramework\Request\Method\DeleteRequestMethod;
use Kartenmacherei\RestFramework\Request\Method\GetRequestMethod;
use Kartenmacherei\RestFramework\Request\Method\PatchRequestMethod;
use Kartenmacherei\RestFramework\Request\Method\PostRequestMethod;
use Kartenmacherei\RestFramework\Request\Method\PutRequestMethod;
use Kartenmacherei\RestFramework\UnitTests\Stubs\RestResourceStubSupportingAllMethods;
use Kartenmacherei\RestFramework\UnitTests\Stubs\RestResourceStubSupportingGetAndPost;

/**
 * @covers \Kartenmacherei\RestFramework\RestResource\RestResource
 */
class RestResourceTest extends \PHPUnit_Framework_TestCase
{

    public function testReturnsExpectedSupportedMethods()
    {
        $resource = new RestResourceStubSupportingAllMethods();
        $expected = [
            new DeleteRequestMethod(),
            new GetRequestMethod(),
            new PatchRequestMethod(),
            new PostRequestMethod(),
            new PutRequestMethod()
        ];

        $this->assertEquals($expected, $resource->getSupportedMethods());
    }

    public function testReturnsGetAndPostMethods()
    {
        $resource = new RestResourceStubSupportingGetAndPost();
        $expected = [
            new GetRequestMethod(),
            new PostRequestMethod()
        ];

        $this->assertEquals($expected, $resource->getSupportedMethods());
    }
}
