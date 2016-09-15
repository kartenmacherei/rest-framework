<?php
namespace Kartenmacherei\BasketService;

use Kartenmacherei\RestFramework\ContentResponse;
use Kartenmacherei\RestFramework\JsonContent;
use Kartenmacherei\RestFramework\Query;

class GetBasketQuery implements Query
{
    /**
     * @var string
     */
    private $basketIdentifier = '';

    /**
     * @param string $basketIdentifier
     */
    public function __construct($basketIdentifier)
    {
        $this->basketIdentifier = $basketIdentifier;
    }

    public function execute()
    {
        return new ContentResponse(
            new JsonContent(
                [
                    'id' => $this->basketIdentifier,
                    'items' => []
                ]
            )
        );
    }
}