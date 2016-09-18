<?php
namespace Kartenmacherei\RestFramework\Response\Content;

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
