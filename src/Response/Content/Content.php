<?php
namespace Kartenmacherei\RestFramework\Response\Content;

interface Content
{
    /**
     * @return string
     */
    public function asString(): string;

    /**
     * @return ContentType
     */
    public function getContentType(): ContentType;
}
