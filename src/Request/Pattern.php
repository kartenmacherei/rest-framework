<?php
namespace Kartenmacherei\RestFramework\Request;

class Pattern
{
    const REGEX_DELIMITER = '/';

    /**
     * @var string
     */
    private $value = '';

    /**
     * @param string $value
     */
    public function __construct($value)
    {
        $this->value = str_replace(self::REGEX_DELIMITER, '\\' . self::REGEX_DELIMITER, $value);
    }

    public function asString(): string
    {
        return sprintf('%s%s%s', self::REGEX_DELIMITER, $this->value, self::REGEX_DELIMITER);
    }
}
