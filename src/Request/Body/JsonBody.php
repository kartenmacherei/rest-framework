<?php
namespace Kartenmacherei\RestFramework\Request\Body;

use Kartenmacherei\RestFramework\EnsureException;
use Kartenmacherei\RestFramework\JsonObject;

class JsonBody extends Body
{
    /**
     * @var JsonObject
     */
    private $json = [];

    /**
     * @param string $jsonString
     */
    public function __construct($jsonString)
    {
        $this->json = $this->decode($jsonString);
    }

    /**
     * @return bool
     */
    public function isJson(): bool
    {
        return true;
    }

    /**
     * @return JsonObject
     */
    public function getJson(): JsonObject
    {
        return $this->json;
    }

    /**
     * @param string $jsonString
     * @return JsonObject
     * @throws EnsureException
     */
    private function decode(string $jsonString): JsonObject
    {
        $decoded = json_decode($jsonString, false);
        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new EnsureException(sprintf('JSON body could not be decoded: %s', json_last_error_msg()));
        }
        return new JsonObject($decoded);
    }

}
