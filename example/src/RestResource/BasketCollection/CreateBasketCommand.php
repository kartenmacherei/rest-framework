<?php
namespace Kartenmacherei\ExampleService\RestResource\BasketCollection;

use Kartenmacherei\RestFramework\Action\Command\Command;
use Kartenmacherei\RestFramework\Response\CreatedResponse;
use Kartenmacherei\RestFramework\Response\Response;

class CreateBasketCommand implements Command
{
    /**
     * @var BasketItem
     */
    private $basketItem;

    /**
     * @return Response
     */
    public function execute(): Response
    {
        return new CreatedResponse();
    }
}
