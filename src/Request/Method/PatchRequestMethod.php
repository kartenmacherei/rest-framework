<?php
namespace Kartenmacherei\RestFramework\Request\Method;

class PatchRequestMethod extends AbstractRequestMethod
{
    /**
     * @return string
     */
    public function asString(): string
    {
        return 'PATCH';
    }
}
