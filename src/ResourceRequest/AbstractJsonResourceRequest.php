<?php
namespace Kartenmacherei\RestFramework\ResourceRequest;

use Kartenmacherei\RestFramework\Request\Body\JsonBody;

abstract class AbstractJsonResourceRequest extends AbstractResourceRequest
{
    /**
     * @param string $selector
     * @return \Kartenmacherei\RestFramework\JsonArray|\Kartenmacherei\RestFramework\JsonObject
     * @throws BadRequestException
     */
    public function getFromJsonInBody(string $selector)
    {
        $body = $this->getRequestBody();
        if (!$body->isJson()) {
            throw new BadRequestException('Request body does not contain JSON');
        }
        /** @var JsonBody $body */
        return $body->query($selector);
    }
}
