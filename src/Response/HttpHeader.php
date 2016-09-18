<?php
namespace Kartenmacherei\RestFramework\Response;

class HttpHeader
{
    private $name = '';

    private $value = '';

    /**
     * HttpHeader constructor.
     * @param string $name
     * @param string $value
     */
    public function __construct($name, $value)
    {
        $this->name = $name;
        $this->value = $value;
    }

    /**
     * @return string
     */
    public function asString(): string
    {
        return sprintf('%s: %s', $this->name, $this->value);
    }


}
