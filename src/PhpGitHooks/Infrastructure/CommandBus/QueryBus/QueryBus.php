<?php

namespace PhpGitHooks\Infrastructure\CommandBus\QueryBus;

use PhpGitHooks\Infrastructure\CommandBus\BusOptionsResolver;
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
        return $this->container->get($this->optionsResolver->getOption('\\'.get_class($query)))->handle($query);
    }
}
