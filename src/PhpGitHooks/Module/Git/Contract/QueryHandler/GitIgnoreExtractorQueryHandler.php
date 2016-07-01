<?php

namespace PhpGitHooks\Module\Git\Contract\QueryHandler;

use PhpGitHooks\Infrastructure\CommandBus\QueryBus\QueryHandlerInterface;
use PhpGitHooks\Infrastructure\CommandBus\QueryBus\QueryInterface;
use PhpGitHooks\Module\Git\Service\GitIgnoreExtractor;

class GitIgnoreExtractorQueryHandler implements QueryHandlerInterface
{
    /**
     * @var GitIgnoreExtractor
     */
    private $gitIgnoreExtractor;

    /**
     * GitIgnoreExtractorQueryHandler constructor.
     *
     * @param GitIgnoreExtractor $gitIgnoreExtractor
     */
    public function __construct(GitIgnoreExtractor $gitIgnoreExtractor)
    {
        $this->gitIgnoreExtractor = $gitIgnoreExtractor;
    }

    /**
     * @param QueryInterface $query
     *
     * @return string
     */
    public function handle(QueryInterface $query)
    {
        return $this->gitIgnoreExtractor->extract();
    }
}
