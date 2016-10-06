<?php
namespace Kartenmacherei\RestFramework;

class JsonObject
{
    /**
     * @var \stdClass
     */
    private $data;

    /**
     * @param \stdClass $data
     */
    public function __construct(\stdClass $data)
    {
        $this->data = $data;
    }

    /**
     * @param string $selector
     * @return bool
     */
    public function has(string $selector): bool
    {
        return property_exists($this->data, $selector);
    }

    /**
     * @param string $selector
     * @return JsonArray|JsonObject
     * @throws JsonException
     */
    public function query(string $selector)
    {
        if (!$this->has($selector)) {
            throw new JsonException(sprintf('element %s not found', $selector));
        }
        $value = $this->data->{$selector};
        if (is_array($value)) {
            return new JsonArray($value);
        } elseif (is_object($value)) {
            return new JsonObject($value);
        }
        return $value;
    }
}
