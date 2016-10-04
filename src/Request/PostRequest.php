<?php
namespace Kartenmacherei\RestFramework\Request;

use Kartenmacherei\RestFramework\Request\Body\Body;
use Kartenmacherei\RestFramework\Request\Body\JsonBody;
use Kartenmacherei\RestFramework\Request\Method\AbstractRequestMethod;
use Kartenmacherei\RestFramework\Request\Method\RequestMethod;
use Kartenmacherei\RestFramework\Request\Method\PostRequestMethod;

class PostRequest extends Request
{
    public function __construct(AbstractRequestMethod $requestMethod, Uri $uri)
    {
        parent::__construct($requestMethod, $uri);
    }


    /**
     * @return RequestMethod
     */
    public function getMethod(): RequestMethod
    {
        return new PostRequestMethod();
    }

    public function getBody(): Body
    {
        switch ($this->getContentType()) {
            case 'application/json':
                return new JsonBody($this->body);
        }
    }
}
