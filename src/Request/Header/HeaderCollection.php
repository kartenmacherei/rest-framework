<?php
namespace Kartenmacherei\RestFramework\Request\Header;

class HeaderCollection
{
    /**
     * @var array
     */
    private $headers = [];

    /**
     * @param Header[] $headers
     */
    private function __construct(array $headers)
    {
        $this->headers = $headers;
    }

    /**
     * @return HeaderCollection
     */
    public static function fromSuperGlobals(): HeaderCollection
    {
        $headers = [];

        foreach ($_SERVER as $name => $value) {
            if (strpos($name, 'HTTP_') === false) {
                continue;
            }
            $headers[$name] = new Header($name, $value);
        }

        return new self($headers);
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
