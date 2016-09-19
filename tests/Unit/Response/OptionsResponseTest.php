<?php
namespace Kartenmacherei\RestFramework\UnitTests\Response;

use Kartenmacherei\RestFramework\Request\Method\GetRequestMethod;
use Kartenmacherei\RestFramework\Request\Method\PutRequestMethod;
use Kartenmacherei\RestFramework\Response\Content\JsonContent;
use Kartenmacherei\RestFramework\Response\ContentResponse;
use Kartenmacherei\RestFramework\Response\OptionsResponse;
use PHPUnit_Framework_TestCase;

class OptionsResponseTest extends PHPUnit_Framework_TestCase
{
    /**
     * @runInSeparateProcess needed because headers are being sent by ContentResponse
     */
    public function testFlush()
    {
        if (!extension_loaded('xdebug')) {
            $this->markTestSkipped('XDebug extension needed');
        }
        $supportedMethods = [new GetRequestMethod(), new PutRequestMethod()];

        $response = new OptionsResponse($supportedMethods);

        $response->flush();

        $expectedHeaders = [
            'Allow: GET,PUT',
            'Access-Control-Allow-Methods: GET,PUT'
        ];

        $actualHeaders = xdebug_get_headers();
        $this->assertEquals($expectedHeaders, $actualHeaders);

        $this->assertSame(200, http_response_code());

    }
}
