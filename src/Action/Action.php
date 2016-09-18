<?php
namespace Kartenmacherei\RestFramework\Action;

use Kartenmacherei\RestFramework\Response\Response;

interface Action
{
    /**
     * @return Response
     */
    public function execute(): Response;
}
