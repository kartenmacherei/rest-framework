<?php
namespace Kartenmacherei\RestFramework;

use Throwable;

class ErrorHandler
{
    public static function register()
    {
        $self = new self();
        set_exception_handler([$self, 'handleException']);
        set_error_handler([$self, 'handleError']);
    }

    /**
     * @param int $errno
     * @param string $errstr
     * @param string $errfile
     * @param int $errline
     * @throws \ErrorException
     */
    public function handleError($errno, $errstr, $errfile = '', $errline = 0)
    {
        throw new \ErrorException($errstr, 0, $errno, $errfile, $errline);
    }

    /**
     * @param Throwable $t
     */
    public function handleException(Throwable $t)
    {
        http_response_code(500);
        header('Content-Type: application/json');
        print(
            json_encode(
                [
                    'class' => get_class($t),
                    'message' => $t->getMessage(),
                    'file' => $t->getFile(),
                    'line' => $t->getLine()
                ]
            )
        );
    }
}