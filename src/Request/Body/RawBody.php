<?php
namespace Kartenmacherei\RestFramework\Request\Body;

class RawBody extends Body
{
    /**
     * @var string
     */
    private $content = '';

    /**
     * @param string $content
     */
    public function __construct(string $content)
    {
        $this->content = $content;
    }

    /**
     * @return string
     */
    public function getContent(): string
    {
        return $this->content;
    }

    /**
     * @return bool
     */
    public function isJson(): bool
    {
        return false;
    }

}
