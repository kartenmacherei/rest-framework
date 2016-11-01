<?php
namespace Kartenmacherei\RestFramework\UnitTests\Stubs;

use Kartenmacherei\RestFramework\Request\Method\AbstractRequestMethod;
use Kartenmacherei\RestFramework\Request\Method\RequestMethod;

class SomeRequestMethod implements RequestMethod
{
    public function equals(AbstractRequestMethod $requestMethod): bool
    {
        return false;
    }

    public function asString(): string
    {
        return 'Some Method';
    }

    public function isOptionsMethod(): bool
    {
        return false;
    }

}
