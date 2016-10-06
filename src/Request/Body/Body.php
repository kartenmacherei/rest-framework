<?php
namespace Kartenmacherei\RestFramework\Request\Body;

use Kartenmacherei\RestFramework\Response\Content\ContentType;

abstract class Body
{
    /**
     * @return Body|JsonBody
     * @throws MissingContentTypeException
     * @throws UnsupportedRequestBodyException
     */
    public static function fromSuperGlobals(): Body
    {
        $content = file_get_contents('php://input');
        if (empty($content)) {
            return new EmptyBody();
        }

        if (!isset($_SERVER['CONTENT_TYPE'])) {
            throw new MissingContentTypeException();
        }

        switch ($_SERVER['CONTENT_TYPE']) {
            case ContentType::JSON:
                return new JsonBody($content);
        }
        throw new UnsupportedRequestBodyException();
    }

    /**
     * @return bool
     */
    abstract public function isJson(): bool;
}
