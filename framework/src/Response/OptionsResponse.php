<?php
namespace Kartenmacherei\RestFramework;

class OptionsResponse implements Response
{
    /**
     * @var RequestMethod[]
     */
    private $supportedMethods = [];

    /**
     * @param RequestMethod[] $supportedMethods
     */
    public function __construct($supportedMethods)
    {
        $this->supportedMethods = $supportedMethods;
    }

    public function flush()
    {
        $methods = [];
        foreach ($this->supportedMethods as $requestMethod) {
            $methods[] = $requestMethod->asString();
        }
        $headerValue = implode(',', $methods);

        header((new HttpHeader('Allow', $headerValue))->asString());
        header((new HttpHeader('Access-Control-Allow-Methods', $headerValue))->asString());
    }

}