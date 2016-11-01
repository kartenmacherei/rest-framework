<?php
namespace Kartenmacherei\RestFramework\Request;

use Kartenmacherei\RestFramework\Request\Body\Body;
use Kartenmacherei\RestFramework\Request\Header\HeaderCollection;
use Kartenmacherei\RestFramework\Request\Method\PostRequestMethod;
use Kartenmacherei\RestFramework\Request\Method\RequestMethod;
use Kartenmacherei\RestFramework\Request\UploadedFile\UploadedFilesCollection;

class PostRequest extends Request
{
    /**
     * @var Body
     */
    private $body;

    /**
     * @var UploadedFilesCollection
     */
    private $uploadedFiles;

    /**
     * @param Uri $uri
     * @param HeaderCollection $headers
     * @param Body $body
     * @param UploadedFilesCollection $uploadedFiles
     */
    public function __construct(Uri $uri, HeaderCollection $headers, Body $body, UploadedFilesCollection $uploadedFiles)
    {
        parent::__construct($uri, $headers);

        $this->body = $body;
        $this->uploadedFiles = $uploadedFiles;
    }

    /**
     * @return Body
     */
    public function getBody(): Body
    {
        return $this->body;
    }

    /**
     * @return UploadedFilesCollection
     */
    public function getUploadedFiles(): UploadedFilesCollection
    {
        return $this->uploadedFiles;
    }

    /**
     * @return RequestMethod
     */
    public function getMethod(): RequestMethod
    {
        return new PostRequestMethod();
    }

}
