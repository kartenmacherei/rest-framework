<?php
namespace Kartenmacherei\RestFramework\Request\Body;

class JsonBody implements Body
{
    /**
     * @return bool
     */
    public function isJson(): bool
    {
        return true;
    }

}
