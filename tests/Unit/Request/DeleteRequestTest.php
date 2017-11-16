<?php declare(strict_types=1);
namespace Kartenmacherei\RestFramework\UnitTests\Request;

use Kartenmacherei\RestFramework\Request\Body\Body;
use Kartenmacherei\RestFramework\Request\DeleteRequest;
use Kartenmacherei\RestFramework\Request\Header\HeaderCollection;
use Kartenmacherei\RestFramework\Request\Uri;
use PHPUnit\Framework\TestCase;
use PHPUnit_Framework_MockObject_MockObject;

/**
 * @covers \Kartenmacherei\RestFramework\Request\DeleteRequest
 * @uses \Kartenmacherei\RestFramework\Request\Request
 */
class DeleteRequestTest extends TestCase
{
    public function testHasBodyReturnsFalse()
    {
        $request = new DeleteRequest(
            $this->getUriMock(),
            $this->getHeaderCollectionMock(),
            [],
            $this->getBodyMock()
        );

        $this->assertTrue($request->hasBody());
    }

    /**
     * @return PHPUnit_Framework_MockObject_MockObject|Body
     */
    private function getBodyMock()
    {
        return $this->createMock(Body::class);
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
