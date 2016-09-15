<?php
namespace Kartenmacherei\RestFramework;

class MethodNotAllowedResponse implements Response
{
    public function flush()
    {
        http_response_code(405);
    }
}