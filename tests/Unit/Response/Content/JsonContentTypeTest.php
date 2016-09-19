<?php
namespace Kartenmacherei\RestFramework\UnitTests\Response\Content;

use Kartenmacherei\RestFramework\Response\Content\JsonContentType;
use PHPUnit_Framework_TestCase;

/**
 * @covers \Kartenmacherei\RestFramework\Response\Content\JsonContentType
 */
class JsonContentTypeTest extends PHPUnit_Framework_TestCase
{
    public function testAsString()
    {
        $this->assertSame('application/json', (new JsonContentType())->asString());
    }
}
