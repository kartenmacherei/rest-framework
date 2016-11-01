<?php
namespace Kartenmacherei\RestFramework\Request\Method;

interface RequestMethod
{
    const DELETE = 'DELETE';
    const GET = 'GET';
    const OPTIONS = 'OPTIONS';
    const PATCH = 'PATCH';
    const PUT = 'PUT';
    const POST = 'POST';

    /**
     * @param AbstractRequestMethod $requestMethod
     * @return bool
     */
    public function equals(AbstractRequestMethod $requestMethod): bool;

    /**
     * @return string
     */
    public function asString(): string;

    /**
     * @return bool
     */
    public function isOptionsMethod(): bool;
}
