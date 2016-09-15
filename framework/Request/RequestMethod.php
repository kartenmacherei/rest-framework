<?php

abstract class RequestMethod
{
    /**
     * @param RequestMethod $requestMethod
     * @return bool
     */
    public function equals(RequestMethod $requestMethod)
    {
        return get_class($this) == get_class($requestMethod);
    }
}