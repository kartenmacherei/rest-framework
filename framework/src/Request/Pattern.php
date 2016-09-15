<?php
namespace Kartenmacherei\RestFramework;

class Pattern
{
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