<?php
namespace Kartenmacherei\RestFramework\UnitTests\Response;

use Kartenmacherei\RestFramework\Response\NoContentResponse;
use PHPUnit_Framework_TestCase;

class NoContentResponseTest extends PHPUnit_Framework_TestCase
{
    /**
     * @runInSeparateProcess needed because headers are being sent by ContentResponse
     */
    public function testFlush()
    {
        if (!extension_loaded('xdebug')) {
            $this->markTestSkipped('XDebug extension needed');
        }
        $response = new NoContentResponse();

        ob_start();
        $response->flush();
        $output = ob_get_clean();

        $expectedHeaders = [];
        $actualHeaders = xdebug_get_headers();
        $this->assertEquals($expectedHeaders, $actualHeaders);

        $this->assertSame(204, http_response_code());
        $this->assertEmpty($output);
    }
}
