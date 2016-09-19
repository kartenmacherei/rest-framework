<?php
namespace Kartenmacherei\RestFramework\Request\Method;

class DeleteRequestMethod extends AbstractRequestMethod
{
    /**
     * @return string
     */
    public function asString(): string
    {
        return RequestMethod::DELETE;
    }
}
