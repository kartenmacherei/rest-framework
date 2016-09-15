<?php

class OptionsResponse implements Response
{
    /**
     * @var RequestMethod[]
     */
    private $supportedMethods = [];

    /**
     * @param RequestMethod[] $supportedMethods
     */
    public function __construct($supportedMethods)
    {
        $this->supportedMethods = $supportedMethods;
    }
}