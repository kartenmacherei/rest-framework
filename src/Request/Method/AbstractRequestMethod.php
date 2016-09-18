<?php
namespace Kartenmacherei\RestFramework\Request\Method;

abstract class AbstractRequestMethod implements RequestMethod
{
    /**
     * @param AbstractRequestMethod $requestMethod
     * @return bool
     */
    public function equals(AbstractRequestMethod $requestMethod)
    {
        return get_class($this) == get_class($requestMethod);
    }
}
