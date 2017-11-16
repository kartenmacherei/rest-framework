<?php declare(strict_types=1);
namespace Kartenmacherei\RestFramework\UnitTests\Request;

use Kartenmacherei\RestFramework\Request\Body\Body;
use Kartenmacherei\RestFramework\Request\PostRequest;
use Kartenmacherei\RestFramework\Request\Header\HeaderCollection;
use Kartenmacherei\RestFramework\Request\UploadedFile\UploadedFilesCollection;
use Kartenmacherei\RestFramework\Request\Uri;
use PHPUnit\Framework\TestCase;
use PHPUnit_Framework_MockObject_MockObject;

/**
 * @covers \Kartenmacherei\RestFramework\Request\PostRequest
 * @uses \Kartenmacherei\RestFramework\Request\Request
 */
class PostRequestTest extends TestCase
{
    public function testHasBodyReturnsFalse()
    {
        $request = new PostRequest(
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
