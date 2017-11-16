<?php declare(strict_types=1);
namespace Kartenmacherei\RestFramework\UnitTests\Request;

use Kartenmacherei\RestFramework\Request\Body\Body;
use Kartenmacherei\RestFramework\Request\PutRequest;
use Kartenmacherei\RestFramework\Request\Header\HeaderCollection;
use Kartenmacherei\RestFramework\Request\UploadedFile\UploadedFilesCollection;
use Kartenmacherei\RestFramework\Request\Uri;
use PHPUnit\Framework\TestCase;
use PHPUnit_Framework_MockObject_MockObject;

/**
 * @covers \Kartenmacherei\RestFramework\Request\PutRequest
 * @uses \Kartenmacherei\RestFramework\Request\Request
 * @uses \Kartenmacherei\RestFramework\Request\PostRequest
 */
class PutRequestTest extends TestCase
{
    public function testHasBodyReturnsFalse()
    {
        $request = new PutRequest(
            $this->getUriMock(),
            $this->getHeaderCollectionMock(),
            $this->getBodyMock(),
            $this->getUploadedFilesCollectionMock()
        );

        $this->assertTrue($request->hasBody());
    }

    /**
     * @return PHPUnit_Framework_MockObject_MockObject|UploadedFilesCollection
     */
    private function getUploadedFilesCollectionMock()
    {
        return $this->createMock(UploadedFilesCollection::class);
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
