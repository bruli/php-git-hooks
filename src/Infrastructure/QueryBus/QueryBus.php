<?php

namespace Infrastructure\QueryBus;

use Infrastructure\CommandBus\BusOptionsResolver;
use Symfony\Component\DependencyInjection\ContainerInterface;

class QueryBus
{
    /**
     * @var ContainerInterface
     */
    private $container;
    /**
     * @var BusOptionsResolver
     */
    private $optionsResolver;

    /**
     * QueryBus constructor.
     *
     * @param ContainerInterface $container
     * @param BusOptionsResolver $optionsResolver
     */
    public function __construct(ContainerInterface $container, BusOptionsResolver $optionsResolver)
    {
        $this->container = $container;
        $this->optionsResolver = $optionsResolver;
    }

    /**
     * @param QueryInterface $query
     *
     * @return mixed
     */
    public function handle(QueryInterface $query)
    {
        $handler = $this->optionsResolver->getQueryOption('\\'.get_class($query));

        return $this->container->get($handler)->handle($query);
    }
}
