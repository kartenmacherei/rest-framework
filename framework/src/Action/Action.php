<?php
namespace Kartenmacherei\RestFramework;

interface Action
{
    /**
     * @return Response
     */
    public function execute();
}