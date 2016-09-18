<?php
namespace Kartenmacherei\RestFramework\Request\Method;

class GetRequestMethod extends AbstractRequestMethod
{
    /**
     * @return string
     */
    public function asString(): string
    {
        return 'GET';
    }
}
