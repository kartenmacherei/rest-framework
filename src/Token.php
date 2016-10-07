<?php
namespace Kartenmacherei\RestFramework;

class Token
{
    /**
     * @var string
     */
    private $value = '';

    /**
     * @param null $value
     */
    public function __construct($value = NULL)
    {
        if (NULL !== $value) {
            $this->value = $value;
        } else {
            $this->setValue();
        }
    }

    /**
     *
     */
    private function setValue()
    {
        $this->value = bin2hex(random_bytes(16));
    }

    /**
     * @return string
     */
    public function asString(): string
    {
        return $this->value;
    }

}
