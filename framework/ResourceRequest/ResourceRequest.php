<?php

interface ResourceRequest
{
    public function getSupportedMethods();

    public function isReadRequest();

    public function isOptionsRequest();
}