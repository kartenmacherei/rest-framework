<?php
namespace Kartenmacherei\RestFramework\Response\Content;

interface Content
{
    /**
     * @return string
     */
    public function asString();

    /**
     * @return ContentType
     */
    public function getContentType();
}
