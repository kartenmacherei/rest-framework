<?php
namespace Kartenmacherei\BasketService;

use Kartenmacherei\RestFramework\ContentResponse;
use Kartenmacherei\RestFramework\JsonContent;
use Kartenmacherei\RestFramework\Query;

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

    public function execute()
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