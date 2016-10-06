<?php
namespace Kartenmacherei\ExampleService\RestResource\BasketCollection;

use Kartenmacherei\RestFramework\Action\Command\Command;
use Kartenmacherei\RestFramework\Response\CreatedResponse;
use Kartenmacherei\RestFramework\Response\Response;

class CreateBasketCommand implements Command
{
    /**
     * @var BasketCollectionResourceRequest $resourceRequest
     */
    private $resourceRequest;

    /**
     * @param BasketCollectionResourceRequest $resourceRequest
     */
    public function __construct(BasketCollectionResourceRequest $resourceRequest)
    {
        $this->resourceRequest = $resourceRequest;
    }

    /**
     * @return Response
     */
    public function execute(): Response
    {
        $item = $this->resourceRequest->getBasketItem();
        var_dump($item);
        return new CreatedResponse();
    }
}
