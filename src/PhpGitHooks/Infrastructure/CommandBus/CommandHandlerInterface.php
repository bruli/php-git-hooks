<?php

namespace PhpGitHooks\Infrastructure\CommandBus;

interface CommandHandlerInterface
{
    /**
     * @param CommandInterface $command
     */
    public function handle(CommandInterface $command);
}
