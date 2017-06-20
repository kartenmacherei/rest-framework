<?php
namespace Kartenmacherei\RestFramework\Request;

use Kartenmacherei\RestFramework\Request\Header\HeaderCollection;
use Kartenmacherei\RestFramework\Request\Method\GetRequestMethod;
use Kartenmacherei\RestFramework\Request\Method\RequestMethod;

class GetRequest extends Request
{
    /**
     * @var array
     */
    private $parameters;

    /**
     * @param Uri $uri
     * @param HeaderCollection $headers
     * @param array $parameters
     */
    public function __construct(Uri $uri, HeaderCollection $headers, array $parameters)
    {
        parent::__construct($uri, $headers);
        $this->parameters = $parameters;
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
            throw new RequestParameterException(sprintf('Parameter %s not found', $name));
        }
        return $this->parameters[$name];
    }

    /**
     * @return RequestMethod
     */
    public function getMethod(): RequestMethod
    {
        return new GetRequestMethod();
    }


}
