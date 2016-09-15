<?php
namespace Kartenmacherei\BasketService;

use Kartenmacherei\RestFramework\Framework;
use Kartenmacherei\RestFramework\ReadOnlyRestResource;
use Kartenmacherei\RestFramework\Request;
use Kartenmacherei\RestFramework\Response;

class Application
{
    /**
     * @param Request $request
     * @return Response
     */
    public function run(Request $request)
    {
        $framework = Framework::createInstance();
        $framework->registerResource(
            new ReadOnlyRestResource(new BasketRouter(), new BasketQueryLocator())
        );
        return $framework->run($request);
    }
}