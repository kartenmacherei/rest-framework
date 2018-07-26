<?php
namespace Kartenmacherei\RestFramework;

use Kartenmacherei\RestFramework\Exception\ExceptionRenderer;
use Kartenmacherei\RestFramework\Exception\ExceptionToJsonRenderer;
use Throwable;

class ErrorHandler
{
    /**
     * @var ExceptionToJsonRenderer
     */
    private $exceptionRenderer;

    /**
     * @param ExceptionRenderer $exceptionRenderer
     */
    public function __construct(ExceptionRenderer $exceptionRenderer)
    {
        $this->exceptionRenderer = $exceptionRenderer;
    }

    /**
     * @codeCoverageIgnore
     *
     * @param ExceptionRenderer $exceptionRenderer
     */
    public static function register(ExceptionRenderer $exceptionRenderer = null)
    {
        if (is_null($exceptionRenderer)) {
            $exceptionRenderer =  new ExceptionToJsonRenderer();
        }

        $self = new self($exceptionRenderer);
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
        throw new \ErrorException($errstr,  $errno,1, $errfile, $errline);
    }

    /**
     * @param Throwable $throwable
     */
    public function handleException(Throwable $throwable)
    {
        http_response_code(500);
        header('Content-Type: application/json');
        print($this->exceptionRenderer->render($throwable));
    }
}
