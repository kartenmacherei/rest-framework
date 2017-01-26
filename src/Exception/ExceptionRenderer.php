<?php
namespace Kartenmacherei\RestFramework\Exception;

interface ExceptionRenderer
{
    /**
     * @param $throwable
     *
     * @return string
     */
    public function render(\Throwable $throwable) : string;
}
