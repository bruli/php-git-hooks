<?php

namespace PhpGitHooks\Module\Git\Service;

use PhpGitHooks\Module\Git\Contract\Response\GitIgnoreDataResponse;
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
     * @return GitIgnoreDataResponse
     */
    public function extract()
    {
        $content = $this->reader->read();

        return new GitIgnoreDataResponse($content);
    }
}
