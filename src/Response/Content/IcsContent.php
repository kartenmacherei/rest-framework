<?php
namespace Kartenmacherei\RestFramework\Response\Content;


class IcsContent implements Content
{
    /**
     * @var string
     */
    private $value;

    /**
     * @param string $value
     */
    public function __construct(string $value)
    {
        $this->value = $value;
    }

    /**
     * @return string
     */
    public function asString(): string
    {
        return $this->value;
    }

    /**
     * @return ContentType
     */
    public function getContentType(): ContentType
    {
        return new IcsContentType();
    }
}