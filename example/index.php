<?php
namespace Kartenmacherei\ExampleService\RestResource\Basket;

use Kartenmacherei\ExampleService\Application;
use Kartenmacherei\RestFramework\ErrorHandler;
use Kartenmacherei\RestFramework\Request\Request;

require __DIR__ .'/../vendor/autoload.php';

ErrorHandler::register();
(new Application())->run(Request::fromSuperGlobals())->flush();
