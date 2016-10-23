<?php
namespace Kartenmacherei\RestFramework;

use Kartenmacherei\RestFramework\Exception\ExceptionToJsonRenderer;
use Throwable;

class ErrorHandler
{
    /**
     * @var ExceptionToJsonRenderer
     */
    private $exceptionRenderer;

    /**
     * @param ExceptionToJsonRenderer $exceptionRenderer
     */
    public function __construct(ExceptionToJsonRenderer $exceptionRenderer)
    {
        $this->exceptionRenderer = $exceptionRenderer;
    }

    /**
     * @codeCoverageIgnore
     */
    public static function register()
    {
        $self = new self(new ExceptionToJsonRenderer());
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
     * @param Throwable $throwable
     */
    public function handleException(Throwable $throwable)
    {
        http_response_code(500);
        header('Content-Type: application/json');
        print($this->exceptionRenderer->toJson($throwable));
    }
}
