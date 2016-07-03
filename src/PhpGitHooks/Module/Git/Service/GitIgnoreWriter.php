<?php

namespace PhpGitHooks\Module\Git\Service;

use PhpGitHooks\Module\Git\Model\WriterInterface;

class GitIgnoreWriter
{
    /**
     * @var WriterInterface
     */
    private $gitIgnoreWriter;

    /**
     * GitIgnoreWriter constructor.
     *
     * @param WriterInterface $gitIgnoreWriter
     */
    public function __construct(WriterInterface $gitIgnoreWriter)
    {
        $this->gitIgnoreWriter = $gitIgnoreWriter;
    }

    /**
     * @param string $content
     */
    public function write($content)
    {
        $this->gitIgnoreWriter->write($content);
    }
}
