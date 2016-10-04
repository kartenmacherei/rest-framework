<?php
namespace Kartenmacherei\RestFramework\Response;

class CreatedResponse implements Response
{
    public function flush()
    {
        http_response_code(201);
    }

}
