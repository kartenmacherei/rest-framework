<?php
namespace Kartenmacherei\RestFramework\UnitTests\Response;

use Kartenmacherei\RestFramework\ResourceRequest\BadRequestException;
use Kartenmacherei\RestFramework\Response\BadRequestResponse;
use Kartenmacherei\RestFramework\Response\Content\JsonContent;
use Kartenmacherei\RestFramework\Response\CreatedResponse;
use PHPUnit_Framework_TestCase;

/**
 * @covers \Kartenmacherei\RestFramework\Response\BadRequestResponse
 */
class BadRequestResponseTest extends PHPUnit_Framework_TestCase
{
    /**
     * @runInSeparateProcess needed because headers are being sent by ContentResponse
     */
    public function testFlush()
    {
        if (!extension_loaded('xdebug')) {
            $this->markTestSkipped('XDebug extension needed');
        }

        $throwable = new BadRequestException('Something went wrong');
        $response = new BadRequestResponse($throwable);

        ob_start();
        $response->flush();
        $output = ob_get_clean();

        $expectedHeaders = ['Content-Type: application/json'];
        $actualHeaders = xdebug_get_headers();
        $this->assertEquals($expectedHeaders, $actualHeaders);

        $this->assertSame(400, http_response_code());

        $actualBodyData = json_decode($output, true);
        $this->assertSame(BadRequestException::class, $actualBodyData['class']);
        $this->assertSame('Something went wrong', $actualBodyData['message']);
    }
}
