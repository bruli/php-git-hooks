<?php

namespace PhpGitHooks\Infrastructure\CommandBus\QueryBus;

interface QueryHandlerInterface
{
    /**
     * @param QueryInterface $query
     *
     * @return mixed
     */
    public function handle(QueryInterface $query);
}
