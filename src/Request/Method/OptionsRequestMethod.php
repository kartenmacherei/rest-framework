<?php
namespace Kartenmacherei\RestFramework\Request\Method;

class OptionsRequestMethod extends AbstractRequestMethod
{
    /**
     * @return string
     */
    public function asString(): string
    {
        return RequestMethod::OPTIONS;
    }
}
