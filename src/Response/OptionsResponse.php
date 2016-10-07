<?php
namespace Kartenmacherei\RestFramework\Response;

use Kartenmacherei\RestFramework\Request\Method\RequestMethod;

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

        http_response_code(200);
        header((new HttpHeader('Allow', $headerValue))->asString());
        header((new HttpHeader('Access-Control-Allow-Methods', $headerValue))->asString());
    }

}
