<?php

namespace PhpGitHooks\Infrastructure\CommandBus\CommandBus;

interface CommandHandlerInterface
{
    /**
     * @param CommandInterface $command
     */
    public function handle(CommandInterface $command);
}
