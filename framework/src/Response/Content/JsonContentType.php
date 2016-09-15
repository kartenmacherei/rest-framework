<?php
namespace Kartenmacherei\RestFramework;

class JsonContentType implements ContentType
{
    /**
     * @return string
     */
    public function asString()
    {
        return 'application/json';
    }

}