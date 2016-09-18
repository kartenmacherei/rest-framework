<?php
namespace Kartenmacherei\RestFramework\Request\Method;

class PatchRequestMethod extends AbstractRequestMethod
{
    /**
     * @return string
     */
    public function asString()
    {
        return 'PATCH';
    }
}
