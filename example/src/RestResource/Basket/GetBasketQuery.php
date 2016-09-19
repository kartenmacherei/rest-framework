<?php
namespace Kartenmacherei\ExampleService\RestResource\Basket;

use Kartenmacherei\ExampleService\Domain\BasketIdentifier;
use Kartenmacherei\RestFramework\Response\ContentResponse;
use Kartenmacherei\RestFramework\Response\Content\JsonContent;
use Kartenmacherei\RestFramework\Action\Query\Query;
use Kartenmacherei\RestFramework\Response\Response;

class GetBasketQuery implements Query
{
    /**
     * @var BasketIdentifier
     */
    private $basketIdentifier;

    /**
     * @param BasketIdentifier $basketIdentifier
     */
    public function __construct(BasketIdentifier $basketIdentifier)
    {
        $this->basketIdentifier = $basketIdentifier;
    }

    public function execute(): Response
    {
        return new ContentResponse(
            new JsonContent(
                [
                    'id' => $this->basketIdentifier->asString(),
                    'items' => []
                ]
            )
        );
    }
}
