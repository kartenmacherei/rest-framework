<?php
namespace Kartenmacherei\RestFramework\Request;

use Kartenmacherei\RestFramework\Request\Method\OptionsRequestMethod;
use Kartenmacherei\RestFramework\Request\Method\RequestMethod;

class OptionsRequest extends Request
{
    /**
     * @return RequestMethod
     */
    public function getMethod(): RequestMethod
    {
        return new OptionsRequestMethod();
    }

    /**
     * @return bool
     */
    public function isOptionsRequest(): bool
    {
        return true;
    }


}
