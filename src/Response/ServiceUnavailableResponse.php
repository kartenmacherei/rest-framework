<?php
namespace Kartenmacherei\RestFramework\Response;

class ServiceUnavailableResponse extends ContentResponse
{
    /**
     * @return int
     */
    protected function getResponseCode(): int
    {
        return 503;
    }

}
