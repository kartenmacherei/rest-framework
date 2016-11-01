<?php
namespace Kartenmacherei\RestFramework\UnitTests\Response;

use Kartenmacherei\RestFramework\Response\Content\JsonContent;
use Kartenmacherei\RestFramework\Response\CreatedResponse;
use PHPUnit_Framework_TestCase;

/**
 * @covers \Kartenmacherei\RestFramework\Response\CreatedResponse
 */
class CreatedResponseTest extends PHPUnit_Framework_TestCase
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
        $response = new CreatedResponse($content);

        ob_start();
        $response->flush();
        $output = ob_get_clean();

        $expectedHeaders = ['Content-Type: application/json'];
        $actualHeaders = xdebug_get_headers();
        $this->assertEquals($expectedHeaders, $actualHeaders);

        $this->assertSame(201, http_response_code());

        $this->assertEquals('"Foo"', $output);
    }
}
