<?php
namespace Kartenmacherei\ExampleService\RestResource\Basket;

use Kartenmacherei\RestFramework\Response\ContentResponse;
use Kartenmacherei\RestFramework\Response\Content\JsonContent;
use Kartenmacherei\RestFramework\Action\Query\Query;
use Kartenmacherei\RestFramework\Response\Response;

class GetBasketQuery implements Query
{
    /**
     * @var BasketResourceRequest
     */
    private $resourceRequest;

    /**
     * @param BasketResourceRequest $resourceRequest
     */
    public function __construct(BasketResourceRequest $resourceRequest)
    {
        $this->resourceRequest = $resourceRequest;
    }

    /**
     * @return Response
     */
    public function execute(): Response
    {
        return new ContentResponse(
            new JsonContent(
                [
                    'id' => $this->resourceRequest->getBasketIdentifier(),
                    'items' => []
                ]
            )
        );
    }
}
