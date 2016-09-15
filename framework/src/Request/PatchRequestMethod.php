<?php
namespace Kartenmacherei\RestFramework;

class PatchRequestMethod extends RequestMethod
{
    public function asString()
    {
        return 'PATCH';
    }

}