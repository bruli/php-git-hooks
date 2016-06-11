<?php

namespace Infrastructure\QueryBus;

use Symfony\Component\DependencyInjection\ContainerInterface;

class QueryBus
{
    private $queryHandlers = [];
    /**
     * @var ContainerInterface
     */
    private $container;

    /**
     * QueryBus constructor.
     *
     * @param ContainerInterface $container
     */
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    /**
     * @param $query
     * @param $queryHandler
     */
    public function addQueryHandler($query, $queryHandler)
    {
        $this->queryHandlers[$query] = $queryHandler;
    }

    /**
     * @param QueryInterface $query
     *
     * @return mixed
     */
    public function handle(QueryInterface $query)
    {
        return $this->container->get($this->queryHandlers['\\'.get_class($query)])->handle($query);
    }
}
