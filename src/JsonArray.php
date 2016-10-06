<?php
namespace Kartenmacherei\RestFramework;

class JsonArray implements \Iterator
{
    /**
     * @var array
     */
    private $data = [];

    /**
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function current()
    {
        $current = current($this->data);
        if (is_array($current)) {
            return new JsonArray($current);
        }
        if (is_object($current)) {
            return new JsonObject($current);
        }
        return $current;
    }

    public function next()
    {
        next($this->data);
    }

    public function key()
    {
        return key($this->data);
    }

    /**
     * @return bool
     */
    public function valid():bool
    {
        return array_key_exists($this->key(), $this->data);
    }

    public function rewind()
    {
        reset($this->data);
    }


}
