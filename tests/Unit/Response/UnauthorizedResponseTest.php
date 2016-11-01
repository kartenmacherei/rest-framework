<?php
namespace Kartenmacherei\RestFramework\UnitTests\Response;

use Kartenmacherei\RestFramework\Response\MethodNotAllowedResponse;
use Kartenmacherei\RestFramework\Response\UnauthorizedResponse;

/**
 * @covers \Kartenmacherei\RestFramework\Response\UnauthorizedResponse
 */
class UnauthorziedResponseTest extends \PHPUnit_Framework_TestCase
{
    public function testFlush()
    {
        (new UnauthorizedResponse())->flush();
        $this->assertSame(401, http_response_code());
    }
}
