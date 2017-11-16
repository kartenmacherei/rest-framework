<?php declare(strict_types=1);
namespace Kartenmacherei\RestFramework\UnitTests\Request;

use Kartenmacherei\RestFramework\Request\GetRequest;
use Kartenmacherei\RestFramework\Request\Header\HeaderCollection;
use Kartenmacherei\RestFramework\Request\Uri;
use PHPUnit\Framework\TestCase;
use PHPUnit_Framework_MockObject_MockObject;

/**
 * @covers \Kartenmacherei\RestFramework\Request\GetRequest
 * @uses \Kartenmacherei\RestFramework\Request\Request
 */
class GetRequestTest extends TestCase
{
    public function testHasBodyReturnsFalse()
    {
        $request = new GetRequest($this->getUriMock(), $this->getHeaderCollectionMock(), []);
        $this->assertFalse($request->hasBody());
    }

    /**
     * @return PHPUnit_Framework_MockObject_MockObject|HeaderCollection
     */
    private function getHeaderCollectionMock()
    {
        return $this->createMock(HeaderCollection::class);
    }

    /**
     * @return PHPUnit_Framework_MockObject_MockObject|Uri
     */
    private function getUriMock()
    {
        return $this->createMock(Uri::class);
    }
}
