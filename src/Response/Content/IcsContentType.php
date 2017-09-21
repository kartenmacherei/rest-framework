<?php
namespace Kartenmacherei\RestFramework\Response\Content;


class IcsContentType extends ContentType
{
    /**
     * @return string
     */
    public function asString(): string
    {
        return self::ICS;
    }
}