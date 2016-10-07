<?php
namespace Kartenmacherei\RestFramework\Response;

class CreatedResponse extends ContentResponse
{
    /**
     * @return int
     */
    protected function getResponseCode(): int
    {
        return 201;
    }

}
