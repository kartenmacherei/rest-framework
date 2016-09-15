<?php
namespace Kartenmacherei\RestFramework;

interface ResourceRequest
{
    public function getSupportedMethods();

    public function isReadRequest();

    public function isOptionsRequest();
}