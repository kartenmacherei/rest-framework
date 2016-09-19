<?php
namespace Kartenmacherei\RestFramework\Request\Method;

class PostRequestMethod extends AbstractRequestMethod
{
    /**
     * @return string
     */
    public function asString(): string
    {
        return RequestMethod::POST;
    }
}
