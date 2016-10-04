<?php
namespace Kartenmacherei\RestFramework\Request\Body;

interface Body
{
    /**
     * @return bool
     */
    public function isJson(): bool;
}
