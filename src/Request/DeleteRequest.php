<?php
namespace Kartenmacherei\RestFramework\Request;

use Kartenmacherei\RestFramework\Request\Method\DeleteRequestMethod;
use Kartenmacherei\RestFramework\Request\Method\RequestMethod;

class DeleteRequest extends GetRequest
{
    /**
     * @return RequestMethod
     */
    public function getMethod(): RequestMethod
    {
        return new DeleteRequestMethod();
    }
}
