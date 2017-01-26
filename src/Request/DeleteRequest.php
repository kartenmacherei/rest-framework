<?php
namespace Kartenmacherei\RestFramework\Request;

use Kartenmacherei\RestFramework\Request\Body\Body;
use Kartenmacherei\RestFramework\Request\Header\HeaderCollection;
use Kartenmacherei\RestFramework\Request\Method\DeleteRequestMethod;
use Kartenmacherei\RestFramework\Request\Method\RequestMethod;

class DeleteRequest extends Request
{
    /**
     * @var array
     */
    private $parameters;

    /**
     * @var Body
     */
    private $body;

    /**
     * @param Uri $uri
     * @param HeaderCollection $headers
     * @param array $parameters
     * @param Body $body
     */
    public function __construct(Uri $uri, HeaderCollection $headers, array $parameters, Body $body)
    {
        parent::__construct($uri, $headers);
        $this->parameters = $parameters;
        $this->body = $body;
    }

    /**
     * @param $name
     * @return bool
     */
    public function hasParameter($name): bool
    {
        return array_key_exists($name, $this->parameters);
    }

    /**
     * @param $name
     * @return mixed
     * @throws RequestParameterException
     */
    public function getParameter($name)
    {
        if (!$this->hasParameter($name)) {
            throw new RequestParameterException(sprintf('Parameter %s not found'));
        }
        return $this->parameters[$name];
    }

    /**
     * @return Body
     */
    public function getBody(): Body
    {
        return $this->body;
    }

    /**
     * @return RequestMethod
     */
    public function getMethod(): RequestMethod
    {
        return new DeleteRequestMethod();
    }
}
