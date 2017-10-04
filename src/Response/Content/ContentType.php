<?php
namespace Kartenmacherei\RestFramework\Response\Content;

abstract class ContentType
{
    const MULTIPART_FORMDATA = 'multipart/form-data';
    const JSON = 'application/json';
    const JSON_UTF8 = 'application/json; charset=UTF-8';
    const PDF = 'application/pdf';
    const PLAIN = 'text/plain';
    const ICS = 'text/calendar; charset=utf-8';

    /**
     * @param $type
     * @return ContentType
     * @throws UnsupportedContentTypeException
     */
    public static function fromString($type): ContentType
    {
        switch ($type) {
            case self::JSON:
            case self::JSON_UTF8:
                return new JsonContentType();
            case self::PDF:
                return new PdfContentType();
            case self::PLAIN:
                return new PlainContentType();
            case self::ICS:
                return new IcsContentType();
        }
        throw new UnsupportedContentTypeException(sprintf('Content type %s is not supported', $type));
    }

    /**
     * @return string
     */
    abstract public function asString(): string;
}
