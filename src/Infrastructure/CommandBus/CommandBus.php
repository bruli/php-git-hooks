<?php

namespace Infrastructure\CommandBus;

use Module\Git\Contract\Command\PreCommitToolCommand;
use Module\Git\Contract\CommandHandler\PreCommitToolCommandHandler;
use Symfony\Component\DependencyInjection\ContainerInterface;

class CommandBus
{

    private $commandHandlers = [];
    /**
     * @var ContainerInterface
     */
    private $container;

    /**
     * CommandBus constructor.
     * @param ContainerInterface $container
     */
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    /**
     * @param string $command
     * @param string $commandHandler
     */
    public function addCommandHandler($command, $commandHandler)
    {
        $this->commandHandlers[$command] = $commandHandler;
    }

    /**
     * @param object $command
     */
    public function handle($command)
    {
        $this->container->get($this->commandHandlers['\\'.get_class($command)])->handle($command);
    }
}
