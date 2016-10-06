<?php
namespace Kartenmacherei\RestFramework\Request\Body;

class EmptyBody extends Body
{
    public function isJson(): bool
    {
        return false;
    }

}
