<?php
namespace Kartenmacherei\ExampleService\RestResource\BasketCollection;

use Kartenmacherei\ExampleService\Domain\BasketItem;
use Kartenmacherei\RestFramework\Request\Body\JsonBody;
use Kartenmacherei\RestFramework\Request\Method\PostRequestMethod;
use Kartenmacherei\RestFramework\ResourceRequest\AbstractResourceRequest;
use Kartenmacherei\RestFramework\ResourceRequest\BadRequestException;

class BasketCollectionResourceRequest extends AbstractResourceRequest
{
    /**
     * @return array
     */
    public function getSupportedMethods(): array
    {
        return [new PostRequestMethod()];
    }

    public function getBasketItem() {
        $body = $this->getRequestBody();
        if (!$body->isJson()) {
            throw new BadRequestException();
        }
        /** @var JsonBody $body */
        $json = $body->getJson();

        return new BasketItem(
            $json->query('sku'),
            $json->query('quantity'),
            $json->query('price')
        );
    }

}
