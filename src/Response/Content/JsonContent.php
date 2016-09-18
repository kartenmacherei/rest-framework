<?php
namespace Kartenmacherei\RestFramework\Response\Content;

class JsonContent implements Content
{
    /**
     * @var string
     */
    private $jsonString;

    /**
     * @param mixed $data
     * @throws EncodeException
     */
    public function __construct($data)
    {
        $encodedData = json_encode($data);
        if (false === $encodedData) {
            throw new EncodeException(
                sprintf('Data could not be encoded into JSON: %s', json_last_error_msg())
            );
        }
        $this->jsonString = $encodedData;
    }

    /**
     * @return string
     */
    public function asString(): string
    {
        return $this->jsonString;
    }

    /**
     * @return ContentType
     */
    public function getContentType(): ContentType
    {
        return new JsonContentType();
    }
}
