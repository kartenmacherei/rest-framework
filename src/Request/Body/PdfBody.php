<?php
namespace Kartenmacherei\RestFramework\Request\Body;

class PdfBody extends Body
{
    /**
     * @var string
     */
    private $content = '';

    /**
     * @param string $content
     */
    public function __construct($content)
    {
        $this->content = $content;
    }

    /**
     * @return bool
     */
    public function isJson(): bool
    {
        return false;
    }

    /**
     * @return string
     */
    public function getContent(): string
    {
        return $this->content;
    }
}
