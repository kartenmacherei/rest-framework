<?php
namespace Kartenmacherei\RestFramework\Response\Content;

use Kartenmacherei\RestFramework\EnsureException;

class PhpObjectContent implements Content
{
    /**
     * @var mixed object
     */
    private $object;

    /**
     * @param mixed $object
     */
    public function __construct($object)
    {
        $this->ensureIsObject($object);
        $this->object = $object;
    }


    /**
     * @return string
     */
    public function asString(): string
    {
        return serialize($this->object);
    }

    /**
     * @return ContentType
     */
    public function getContentType(): ContentType
    {
        return new PlainContentType();
    }

    /**
     * @param $value
     * @throws EnsureException
     */
    private function ensureIsObject($value)
    {
        if (!is_object($value)) {
            throw new EnsureException('Value must be an object');
        }
    }
}
