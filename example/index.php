<?php
namespace Kartenmacherei\BasketService;

use Kartenmacherei\RestFramework\ErrorHandler;
use Kartenmacherei\RestFramework\Request;

require __DIR__ . '/../framework/src/autoload.php';
require __DIR__ .'/src/autoload.php';

ErrorHandler::register();
(new Application())->run(Request::fromSuperGlobals())->flush();