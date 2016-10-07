<?php
namespace Kartenmacherei\RestFramework\Router;

use Kartenmacherei\RestFramework\Request\Request;

interface AclRule
{

    /**
     * @param Request $request
     * @return bool
     */
    public function complies(Request $request): bool;
}
