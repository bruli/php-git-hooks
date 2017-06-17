<?php

namespace PhpGitHooks\Module\Git\Contract\Command;

use Bruli\EventBusBundle\CommandBus\CommandInterface;

class GitIgnoreWriter implements CommandInterface
{
    /**
     * @var string
     */
    private $content;

    /**
     * GitIgnoreWriterCommand constructor.
     *
     * @param string $content
     */
    public function __construct($content)
    {
        $this->content = $content;
    }

    /**
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }
}
