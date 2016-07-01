<?php

namespace PhpGitHooks\Module\Git\Service;

use PhpGitHooks\Module\Git\Model\ReaderInterface;

class GitIgnoreExtractor
{
    /**
     * @var ReaderInterface
     */
    private $reader;

    /**
     * GitIgnoreExtractor constructor.
     *
     * @param ReaderInterface $reader
     */
    public function __construct(ReaderInterface $reader)
    {
        $this->reader = $reader;
    }

    /**
     * @return string
     */
    public function extract()
    {
        return $this->reader->read();
    }
}
