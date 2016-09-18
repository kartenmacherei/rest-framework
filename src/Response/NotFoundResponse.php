<?php
namespace Kartenmacherei\RestFramework\Response;

class NotFoundResponse implements Response
{
    public function flush()
    {
        http_response_code(404);
    }

}
