<?php
namespace Kartenmacherei\RestFramework\UnitTests\Response;

use Kartenmacherei\RestFramework\Response\MethodNotAllowedResponse;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Kartenmacherei\RestFramework\Response\MethodNotAllowedResponse
 */
class MethodNotAllowedResponseTest extends TestCase
{
    public function testFlush()
    {
        (new MethodNotAllowedResponse())->flush();
        $this->assertSame(405, http_response_code());
    }
}
