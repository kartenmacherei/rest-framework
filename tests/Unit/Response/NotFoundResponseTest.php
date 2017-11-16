<?php
namespace Kartenmacherei\RestFramework\UnitTests\Response;

use Kartenmacherei\RestFramework\Response\NotFoundResponse;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Kartenmacherei\RestFramework\Response\NotFoundResponse
 */
class NotFoundResponseTest extends TestCase
{
    public function testFlush()
    {
        (new NotFoundResponse())->flush();
        $this->assertSame(404, http_response_code());
    }
}
