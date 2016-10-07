<?php
namespace Kartenmacherei\RestFramework\Response;

use Kartenmacherei\RestFramework\Response\Content\Content;

class ContentResponse implements Response
{
    /**
     * @var Content
     */
    private $content;

    /**
     * @param Content $content
     */
    public function __construct(Content $content)
    {
        $this->content = $content;
    }

    public function flush()
    {
        http_response_code($this->getResponseCode());
        header((new HttpHeader('Content-Type', $this->content->getContentType()->asString()))->asString());

        print($this->content->asString());
    }

    /**
     * @return int
     */
    protected function getResponseCode(): int
    {
        return 200;
    }

}
