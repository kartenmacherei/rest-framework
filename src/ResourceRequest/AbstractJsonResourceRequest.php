<?php
namespace Kartenmacherei\RestFramework\ResourceRequest;

use Kartenmacherei\RestFramework\Request\Body\JsonBody;

abstract class AbstractJsonResourceRequest implements ResourceRequest
{
    /**
     * @var JsonBody
     */
    private $body;

    /**
     * @param JsonBody $body
     */
    public function __construct(JsonBody $body)
    {
        $this->body = $body;
    }

    /**
     * @param string $selector
     * @return \Kartenmacherei\RestFramework\JsonArray|\Kartenmacherei\RestFramework\JsonObject
     */
    public function getFromJsonInBody(string $selector)
    {
        return $this->body->query($selector);
    }
}
