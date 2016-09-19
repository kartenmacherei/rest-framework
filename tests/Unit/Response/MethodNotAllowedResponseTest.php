<?php
namespace Kartenmacherei\RestFramework\UnitTests\Response;

use Kartenmacherei\RestFramework\Response\MethodNotAllowedResponse;

/**
 * @covers \Kartenmacherei\RestFramework\Response\MethodNotAllowedResponse
 */
class MethodNotAllowedResponseTest extends \PHPUnit_Framework_TestCase
{
    public function testFlush()
    {
        (new MethodNotAllowedResponse())->flush();
        $this->assertSame(405, http_response_code());
    }
}
