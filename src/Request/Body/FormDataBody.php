<?php
namespace Kartenmacherei\RestFramework\Request\Body;

class FormDataBody extends Body
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

    /**
     * @param string $name
     * @return bool
     */
    public function has(string $name): bool
    {
        return array_key_exists($name, $this->data);
    }

    /**
     * @param string $name
     * @return mixed
     * @throws BodyException
     */
    public function get(string $name)
    {
        if (!$this->has($name)) {
            throw new BodyException(sprintf('Form field %s not found', $name));
        }
        return $this->data[$name];
    }

    /**
     * @return bool
     */
    public function isJson(): bool
    {
        return false;
    }

}
