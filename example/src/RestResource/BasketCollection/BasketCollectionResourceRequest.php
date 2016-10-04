<?php
namespace Kartenmacherei\ExampleService\RestResource\BasketCollection;

use Kartenmacherei\RestFramework\Request\Method\PostRequestMethod;
use Kartenmacherei\RestFramework\ResourceRequest\AbstractResourceRequest;

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

    }

}
