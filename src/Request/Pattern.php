<?php
namespace Kartenmacherei\RestFramework\Request;

class Pattern
{
    /**
     * @var string
     */
    private $value = '';

    /**
     * TODO escape pattern / enclose in delimiters automatically
     *
     * @param string $value
     */
    public function __construct($value)
    {
        $this->value = $value;
    }

    public function asString()
    {
        return $this->value;
    }
}
