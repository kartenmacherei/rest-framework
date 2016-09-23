<?php
namespace Kartenmacherei\ExampleService;

use Kartenmacherei\ExampleService\RestResource\Basket\BasketQueryLocator;
use Kartenmacherei\ExampleService\RestResource\Basket\BasketResourceRouter;
use Kartenmacherei\RestFramework\Framework;
use Kartenmacherei\RestFramework\RestResource\ReadOnlyRestResource;
use Kartenmacherei\RestFramework\Request\Request;
use Kartenmacherei\RestFramework\Response\Response;

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
        return $framework->run($request);
    }
}
