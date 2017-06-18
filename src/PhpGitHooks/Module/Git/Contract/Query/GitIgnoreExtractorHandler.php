<?php

namespace PhpGitHooks\Module\Git\Contract\Query;

use Bruli\EventBusBundle\QueryBus\QueryHandlerInterface;
use Bruli\EventBusBundle\QueryBus\QueryInterface;
use PhpGitHooks\Module\Git\Contract\Response\GitIgnoreDataResponse;
use PhpGitHooks\Module\Git\Model\ReaderInterface;

class GitIgnoreExtractorHandler implements QueryHandlerInterface
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
    private function extract()
    {
        $content = $this->reader->read();

        return new GitIgnoreDataResponse($content);
    }

    /**
     * @param QueryInterface $query
     *
     * @return GitIgnoreDataResponse|GitIgnoreExtractor
     */
    public function handle(QueryInterface $query)
    {
        return $this->extract();
    }
}
