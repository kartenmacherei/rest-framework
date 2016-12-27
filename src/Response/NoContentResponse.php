<?php
namespace Kartenmacherei\RestFramework\Response;

class NoContentResponse implements Response
{
    public function flush()
    {
        http_response_code($this->getResponseCode());
    }

    /**
     * @return int
     */
    protected function getResponseCode(): int
    {
        return 204;
    }

}
