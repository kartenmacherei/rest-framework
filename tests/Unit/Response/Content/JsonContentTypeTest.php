<?php
namespace Kartenmacherei\RestFramework\UnitTests\Response\Content;

use Kartenmacherei\RestFramework\Response\Content\JsonContentType;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Kartenmacherei\RestFramework\Response\Content\JsonContentType
 */
class JsonContentTypeTest extends TestCase
{
    public function testAsString()
    {
        $this->assertSame('application/json; charset=UTF-8', (new JsonContentType())->asString());
    }
}
