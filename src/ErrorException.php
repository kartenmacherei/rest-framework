<?php
namespace Kartenmacherei\RestFramework;

use Exception;

class ErrorException extends Exception
{
    /**
     * ErrorException constructor.
     * @param string $type
     * @param int $message
     * @param string $file
     * @param $line
     */
    public function __construct($type, $message, $file, $line)
    {
        $message = sprintf(
            '%s in file %s on line %d: %s',
            $type,
            $message,
            $file,
            $line
        );
        parent::__construct($message);
    }
}