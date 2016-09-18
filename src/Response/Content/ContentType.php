<?php
namespace Kartenmacherei\RestFramework\Response\Content;

interface ContentType
{
    /**
     * @return string
     */
    public function asString(): string;
}
