<?php
namespace Kartenmacherei\RestFramework\Request\Method;

interface RequestMethod
{
    /**
     * @param AbstractRequestMethod $requestMethod
     * @return bool
     */
    public function equals(AbstractRequestMethod $requestMethod): bool;

    /**
     * @return string
     */
    public function asString(): string;
}
