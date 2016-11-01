<?php
namespace Kartenmacherei\RestFramework\Request;

use Kartenmacherei\RestFramework\Request\Method\PatchRequestMethod;
use Kartenmacherei\RestFramework\Request\Method\RequestMethod;

class PatchRequest extends PostRequest
{
    /**
     * @return RequestMethod
     */
    public function getMethod(): RequestMethod
    {
        return new PatchRequestMethod();
    }

}
