<?php

interface Action
{
    /**
     * @return Response
     */
    public function execute();
}