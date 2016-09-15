<?php
namespace Kartenmacherei\RestFramework;

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
        http_response_code(200);
        header((new HttpHeader('Content-Type', $this->content->getContentType()->asString()))->asString());

        print($this->content->asString());
    }

}