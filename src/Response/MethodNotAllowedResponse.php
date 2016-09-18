<?php
namespace Kartenmacherei\RestFramework\Response;

class MethodNotAllowedResponse implements Response
{
    public function flush()
    {
        http_response_code(405);
    }
}
