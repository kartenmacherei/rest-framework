<?php
namespace Kartenmacherei\RestFramework\Exception;

class ExceptionToJsonRenderer implements ExceptionRenderer
{
    /**
     * @param $throwable
     *
     * @return string
     */
    public function render(\Throwable $throwable): string
    {
        return $this->toJson($throwable);
    }

    /**
     * @param \Throwable $throwable
     * @return string
     */
    private function toJson(\Throwable $throwable): string
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
