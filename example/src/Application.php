<?php
namespace Kartenmacherei\ExampleService;

use Kartenmacherei\ExampleService\RestResource\Basket\BasketQueryLocator;
use Kartenmacherei\ExampleService\RestResource\Basket\BasketResourceRouter;
use Kartenmacherei\ExampleService\RestResource\BasketCollection\BasketCollectionCommandLocator;
use Kartenmacherei\ExampleService\RestResource\BasketCollection\BasketCollectionResourceRouter;
use Kartenmacherei\RestFramework\Framework;
use Kartenmacherei\RestFramework\RestResource\ReadOnlyRestResource;
use Kartenmacherei\RestFramework\Request\Request;
use Kartenmacherei\RestFramework\Response\Response;
use Kartenmacherei\RestFramework\RestResource\WriteOnlyRestResource;

class Application
{
    /**
     * @param Request $request
     * @return Response
     */
    public function run(Request $request)
    {
        $framework = Framework::createInstance();
        $framework->registerResource(new ReadOnlyRestResource(new BasketResourceRouter(), new BasketQueryLocator()));
        $framework->registerResource(new WriteOnlyRestResource(new BasketCollectionResourceRouter(), new BasketCollectionCommandLocator()));
        return $framework->run($request);
    }
}
