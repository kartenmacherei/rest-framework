<?php
namespace Kartenmacherei\RestFramework\Response\Content;

class JsonContentType extends ContentType
{
    /**
     * @return string
     */
    public function asString(): string
    {
        return self::JSON_UTF8;
    }

}
