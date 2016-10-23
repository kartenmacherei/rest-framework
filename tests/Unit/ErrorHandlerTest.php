<?php
namespace Kartenmacherei\RestFramework\UnitTests;

use ErrorException;
use Kartenmacherei\RestFramework\ErrorHandler;
use Kartenmacherei\RestFramework\Exception\ExceptionToJsonRenderer;
use PHPUnit_Framework_TestCase;

/**
 * @covers \Kartenmacherei\RestFramework\ErrorHandler
 */
class ErrorHandlerTest extends PHPUnit_Framework_TestCase
{
    public function testThrowsExceptionOnError()
    {
        $handler = new ErrorHandler(new ExceptionToJsonRenderer());
        $this->expectException(ErrorException::class);
        $this->expectExceptionMessage('Some Error');

        $handler->handleError(E_NOTICE, 'Some Error', 'somefile.php', 23);
    }

    /**
     * @runInSeparateProcess
     */
    public function testOutputsExceptionAsJson()
    {
        if (!extension_loaded('xdebug')) {
            $this->markTestSkipped('XDebug extension needed');
        }

        $handler = new ErrorHandler(new ExceptionToJsonRenderer());
        ob_start();
        $handler->handleException(new ErrorException('Something went wrong', 0, 1, 'somefile.php', 23));

        $actualOutput = ob_get_clean();
        $expectedOutput = '{
            "class": "ErrorException", "message": "Something went wrong", "file": "somefile.php", "line": 23
        }';
        $this->assertJsonStringEqualsJsonString($expectedOutput, $actualOutput);

        $expectedHeaders = ['Content-Type: application/json'];
        $actualHeaders = xdebug_get_headers();
        $this->assertEquals($expectedHeaders, $actualHeaders);

        $this->assertSame(500, http_response_code());
    }
}
