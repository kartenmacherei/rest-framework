<?php
namespace Kartenmacherei\RestFramework\Response\Content;

class PlainContentType extends ContentType
{
    /**
     * @return string
     */
    public function asString(): string
    {
        return self::PLAIN;
    }
    
}
