<?php
namespace Kartenmacherei\RestFramework\Response;

class UnauthorizedResponse implements Response
{
    public function flush()
    {
        http_response_code(401);
    }

}
