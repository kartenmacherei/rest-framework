<?php
namespace Kartenmacherei\RestFramework;

class Token
{
    /**
     * @var string
     */
    private $_value = '';

    /**
     * @param null $value
     */
    public function __construct($value = NULL)
    {
        if (NULL !== $value) {
            $this->_value = $value;
        } else {
            $this->_setValue();
        }
    }

    /**
     *
     */
    private function _setValue()
    {
        $this->_value = bin2hex(random_bytes(16));
    }

    /**
     * @return string
     */
    public function asString(): string
    {
        return $this->_value;
    }

}
