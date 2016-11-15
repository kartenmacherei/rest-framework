<?php
namespace Kartenmacherei\RestFramework\Response\Content;

class PdfContentType extends ContentType 
{
    /**
     * @return string
     */
    public function asString(): string
    {
        return self::PDF;
    }
}