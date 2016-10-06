<?php
namespace Kartenmacherei\ExampleService\RestResource\BasketCollection;

use Kartenmacherei\RestFramework\Action\Command\AbstractCommandLocator;
use Kartenmacherei\RestFramework\Action\Command\Command;
use Kartenmacherei\RestFramework\Request\Method\PostRequestMethod;
use Kartenmacherei\RestFramework\Request\Method\UnsupportedRequestMethodException;
use Kartenmacherei\RestFramework\ResourceRequest\ResourceRequest;

class BasketCollectionCommandLocator extends AbstractCommandLocator
{
    /**
     * @param ResourceRequest $resourceRequest
     * @return Command
     * @throws UnsupportedRequestMethodException
     */
    protected function buildCommand(ResourceRequest $resourceRequest): Command
    {
        /** @var BasketCollectionResourceRequest $resourceRequest */
        if ($resourceRequest->getRequestMethod()->equals(new PostRequestMethod())) {
            return new CreateBasketCommand($resourceRequest);
        }
        throw new UnsupportedRequestMethodException();
    }

    /**
     * @param ResourceRequest $resourceRequest
     * @return bool
     */
    protected function matches(ResourceRequest $resourceRequest): bool
    {
        return $resourceRequest instanceof BasketCollectionResourceRequest;
    }

}
