<?php

namespace Module\PhpCs\Contract\CommandHandler;

use Infrastructure\CommandBus\CommandHandlerInterface;
use Infrastructure\CommandBus\CommandInterface;
use Module\PhpCs\Contract\Command\PhpCsToolCommand;

class PhpCsToolCommandHandler implements CommandHandlerInterface
{
    /**
     * @param CommandInterface|PhpCsToolCommand $command
     */
    public function handle(CommandInterface $command)
    {
    }
}
