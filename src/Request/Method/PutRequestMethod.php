<?php
namespace Kartenmacherei\RestFramework\Request\Method;

class PutRequestMethod extends AbstractRequestMethod
{
    /**
     * @return string
     */
    public function asString(): string
    {
        return RequestMethod::PUT;
    }
}
