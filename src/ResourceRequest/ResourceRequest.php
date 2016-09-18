<?php
namespace Kartenmacherei\RestFramework\ResourceRequest;

interface ResourceRequest
{
    public function getSupportedMethods();

    public function isReadRequest();

    public function isOptionsRequest();
}
