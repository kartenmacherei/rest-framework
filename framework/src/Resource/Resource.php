<?php
namespace Kartenmacherei\RestFramework;

interface RestResource
{
    /**
     * @return Router
     */
    public function getRouter();

    /**
     * @return bool
     */
    public function hasQueryLocator();

    /**
     * @return bool
     */
    public function hasCommandLocator();

    /**
     * @return QueryLocator
     */
    public function getQueryLocator();

    /**
     * @return CommandLocator
     */
    public function getCommandLocator();
}