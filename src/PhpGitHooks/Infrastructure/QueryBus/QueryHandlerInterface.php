<?php

namespace PhpGitHooks\Infrastructure\QueryBus;

interface QueryHandlerInterface
{
    /**
     * @param QueryInterface $query
     *
     * @return mixed
     */
    public function handle(QueryInterface $query);
}
