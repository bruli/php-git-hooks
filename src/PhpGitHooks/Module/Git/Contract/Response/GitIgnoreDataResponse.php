<?php

namespace PhpGitHooks\Module\Git\Contract\Response;

class GitIgnoreDataResponse
{
    /**
     * @var null|string
     */
    private $content;

    /**
     * GitIgnoreDataResponse constructor.
     *
     * @param string|null $content
     */
    public function __construct($content)
    {
        $this->content = $content;
    }

    /**
     * @return null|string
     */
    public function getContent()
    {
        return $this->content;
    }
}
