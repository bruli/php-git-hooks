<?php

namespace PhpGitHooks\Module\Shared\Tests\Infrastructure;

use PhpGitHooks\Infrastructure\CommandBus\QueryBus\QueryBus;
use PhpGitHooks\Infrastructure\CommandBus\QueryBus\QueryInterface;
use PhpGitHooks\Module\Tests\Infrastructure\UnitTestCase\Mock;
use PhpGitHooks\Module\Tests\Infrastructure\UnitTestCase\SimilarTo;

trait QueryBusTrait
{
    /**
     * @var QueryBus
     */
    private $queryBus;

    /**
     * @return \Mockery\MockInterface|QueryBus
     */
    protected function getQueryBus()
    {
        return $this->queryBus = $this->queryBus ?: Mock::get(QueryBus::class);
    }

    /**
     * @param QueryInterface $query
     * @param mixed          $return
     */
    protected function shouldHandleQuery(QueryInterface $query, $return)
    {
        $this->getQueryBus()
            ->shouldReceive('handle')
            ->once()
            ->with((new SimilarTo())->compare($query))
            ->andReturn($return);
    }
}
