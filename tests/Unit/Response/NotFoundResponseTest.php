<?php
namespace Kartenmacherei\RestFramework\UnitTests\Response;

use Kartenmacherei\RestFramework\Response\NotFoundResponse;

/**
 * @covers \Kartenmacherei\RestFramework\Response\NotFoundResponse
 */
class NotFoundResponseTest extends \PHPUnit_Framework_TestCase
{
    public function testFlush()
    {
        (new NotFoundResponse())->flush();
        $this->assertSame(404, http_response_code());
    }
}
