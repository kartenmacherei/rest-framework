<?php
namespace Kartenmacherei\RestFramework\Exception;

class ExceptionToJsonRenderer
{
    /**
     * @param \Throwable $throwable
     * @return string
     */
    public function toJson(\Throwable $throwable): string
    {
        return json_encode(
            [
                'class' => get_class($throwable),
                'message' => $throwable->getMessage(),
                'file' => $throwable->getFile(),
                'line' => $throwable->getLine()
            ]
        );
    }
}
