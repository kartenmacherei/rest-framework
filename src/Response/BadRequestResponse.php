<?php
namespace Kartenmacherei\RestFramework\Response;

class BadRequestResponse implements Response
{
    /**
     * @var \Throwable
     */
    private $throwable;

    /**
     * @param \Throwable $throwable
     */
    public function __construct(\Throwable $throwable)
    {
        $this->throwable = $throwable;
    }

    public function flush()
    {
        http_response_code(400);
        header('Content-Type: application/json');
        print(
            json_encode(
                [
                    'class' => get_class($this->throwable),
                    'message' => $this->throwable->getMessage(),
                    'file' => $this->throwable->getFile(),
                    'line' => $this->throwable->getLine()
                ]
            )
        );
    }

}
