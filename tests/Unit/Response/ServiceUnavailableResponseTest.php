<?php
namespace Kartenmacherei\RestFramework\UnitTests\Response;

use Kartenmacherei\RestFramework\Response\Content\JsonContent;
use Kartenmacherei\RestFramework\Response\ServiceUnavailableResponse;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Kartenmacherei\RestFramework\Response\ServiceUnavailableResponse
 */
class ServiceUnavailableResponseTest extends TestCase
{
    /**
     * @runInSeparateProcess needed because headers are being sent by ContentResponse
     */
    public function testFlush()
    {
        if (!extension_loaded('xdebug')) {
            $this->markTestSkipped('XDebug extension needed');
        }
        $content = new JsonContent('Foo');
        $response = new ServiceUnavailableResponse($content);

        ob_start();
        $response->flush();
        $output = ob_get_clean();

        $expectedHeaders = ['Content-Type: application/json'];
        $actualHeaders = xdebug_get_headers();
        $this->assertEquals($expectedHeaders, $actualHeaders);

        $this->assertSame(503, http_response_code());

        $this->assertEquals('"Foo"', $output);
    }
}
