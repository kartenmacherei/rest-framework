<?php
namespace Kartenmacherei\RestFramework\Request\Header;

class HeaderCollection
{
    /**
     * @var array
     */
    private $headers = [];

    /**
     * @return HeaderCollection
     */
    public static function fromSuperGlobals(): HeaderCollection
    {
        $collection = new self();
        foreach ($_SERVER as $name => $value) {
            if (strpos($name, 'HTTP_') === false) {
                continue;
            }
            $collection->addHeader(new Header($name, $value));
        }
        return $collection;
    }

    /**
     * @param Header $header
     */
    private function addHeader(Header $header)
    {
        $this->headers[$header->getName()] = $header;
    }

    /**
     * @param string $name
     * @return bool
     */
    public function has(string $name)
    {
        return array_key_exists($name, $this->headers);
    }

    /**
     * @param string $name
     * @return Header
     * @throws HeaderException
     */
    public function get(string $name)
    {
        if (!$this->has($name)) {
            throw new HeaderException(sprintf('Header %s not found', $name));
        }
        return $this->headers[$name];
    }
}
