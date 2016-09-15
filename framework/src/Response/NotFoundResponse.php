<?php
namespace Kartenmacherei\RestFramework;

class NotFoundResponse implements Response
{
    public function flush()
    {
        http_response_code(404);
    }

}