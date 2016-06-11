<?php

namespace Module\PhpUnit\Contract\CommandHandler;

use Infrastructure\CommandBus\CommandHandlerInterface;
use Infrastructure\CommandBus\CommandInterface;

class PhpUnitToolCommandHandler implements CommandHandlerInterface
{
    /**
     * @param CommandInterface $command
     */
    public function handle(CommandInterface $command)
    {
        // TODO: Implement handle() method.
    }
}
