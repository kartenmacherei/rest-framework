<?php
namespace Kartenmacherei\RestFramework\UnitTests\Response;

use Kartenmacherei\RestFramework\Response\Content\JsonContent;
use Kartenmacherei\RestFramework\Response\ContentResponse;
use PHPUnit\Framework\TestCase;

class ContentResponseTest extends TestCase
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
        $response = new ContentResponse($content);

        ob_start();
        $response->flush();
        $output = ob_get_clean();

        $expectedHeaders = ['Content-Type: application/json; charset=UTF-8'];
        $actualHeaders = xdebug_get_headers();
        $this->assertEquals($expectedHeaders, $actualHeaders);

        $this->assertSame(200, http_response_code());

        $this->assertEquals('"Foo"', $output);
    }
}
