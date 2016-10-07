<?php
namespace Kartenmacherei\RestFramework\Request\Method;

class GetRequestMethod extends AbstractRequestMethod
{
    /**
     * @return string
     */
    public function asString(): string
    {
        return RequestMethod::GET;
    }

    /**
     * @return bool
     */
    public function isReadMethod(): bool
    {
        return true;
    }


}
