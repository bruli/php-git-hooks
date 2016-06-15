<?php

namespace PhpGitHooks\Infrastructure\CommandBus;

use Symfony\Component\DependencyInjection\ContainerInterface;

class CommandBus
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
     * CommandBus constructor.
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
     * @param CommandInterface $command
     */
    public function handle(CommandInterface $command)
    {
        $this->container->get($this->optionsResolver->getOption('\\'.get_class($command)))->handle($command);
    }
}
