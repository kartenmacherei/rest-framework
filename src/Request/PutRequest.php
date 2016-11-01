<?php
namespace Kartenmacherei\RestFramework\Request;

use Kartenmacherei\RestFramework\Request\Method\PutRequestMethod;
use Kartenmacherei\RestFramework\Request\Method\RequestMethod;

class PutRequest extends PostRequest
{
    /**
     * @return RequestMethod
     */
    public function getMethod(): RequestMethod
    {
        return new PutRequestMethod();
    }

}
