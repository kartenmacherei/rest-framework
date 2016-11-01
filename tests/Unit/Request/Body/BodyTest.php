<?php
namespace Kartenmacherei\RestFramework\UnitTests\Request\Body;

use Kartenmacherei\RestFramework\Request\Body\Body;
use Kartenmacherei\RestFramework\Request\Body\EmptyBody;
use Kartenmacherei\RestFramework\Request\Body\JsonBody;
use Kartenmacherei\RestFramework\Request\Body\RawBody;
use Kartenmacherei\RestFramework\Request\Body\UnsupportedRequestBodyException;
use Kartenmacherei\RestFramework\Response\Content\ContentType;
use Kartenmacherei\RestFramework\Response\Content\UnsupportedContentTypeException;

/**
 * @covers \Kartenmacherei\RestFramework\Request\Body\Body
 * @covers \Kartenmacherei\RestFramework\Request\Body\RawBody
 * @covers \Kartenmacherei\RestFramework\Request\Body\JsonBody
 * @covers \Kartenmacherei\RestFramework\JsonObject
 */
class BodyTest extends \PHPUnit_Framework_TestCase
{
    public function testCreatesRawBodyIfContentTypeIsEmpty()
    {
        $_SERVER['CONTENT_TYPE'] = '';
        $this->assertInstanceOf(RawBody::class, Body::fromSuperGlobals(__DIR__  . '/fixtures/rawBody.txt'));
    }

    public function testCreatesRawBodyIfContentTypeIsMissing()
    {
        unset($_SERVER['CONTENT_TYPE']);
        $this->assertInstanceOf(RawBody::class, Body::fromSuperGlobals(__DIR__  . '/fixtures/rawBody.txt'));
    }

    public function testCreatesEmptyBodyIfInputStreamIsEmpty()
    {
        $_SERVER['CONTENT_TYPE'] = '';
        $this->assertInstanceOf(EmptyBody::class, Body::fromSuperGlobals(__DIR__  . '/fixtures/emptyBody.txt'));
    }

    public function testCreatesJsonBody()
    {
        $_SERVER['CONTENT_TYPE'] = ContentType::JSON;
        $this->assertInstanceOf(JsonBody::class, Body::fromSuperGlobals(__DIR__  . '/fixtures/jsonBody.txt'));
    }

    public function testThrowsExceptionIfContentTypeIsNotSupported()
    {
        $_SERVER['CONTENT_TYPE'] = 'foo';
        $this->expectException(UnsupportedRequestBodyException::class);
        Body::fromSuperGlobals(__DIR__  . '/fixtures/rawBody.txt');
    }
}
