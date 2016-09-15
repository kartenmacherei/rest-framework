<?php
namespace Kartenmacherei\RestFramework;

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