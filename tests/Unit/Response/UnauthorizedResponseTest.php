<?php
namespace Kartenmacherei\RestFramework\UnitTests\Response;

use Kartenmacherei\RestFramework\Response\UnauthorizedResponse;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Kartenmacherei\RestFramework\Response\UnauthorizedResponse
 */
class UnauthorziedResponseTest extends TestCase
{
    public function testFlush()
    {
        (new UnauthorizedResponse())->flush();
        $this->assertSame(401, http_response_code());
    }
}
