<?php

namespace Module\PhpCsFixer\Contract\CommandHandler;

use Infrastructure\CommandBus\CommandHandlerInterface;
use Infrastructure\CommandBus\CommandInterface;
use Module\PhpCsFixer\Contract\Command\PhpCsFixerToolCommand;

class PhpCsFixerToolCommandHandler implements CommandHandlerInterface
{
    /**
     * @param CommandInterface|PhpCsFixerToolCommand $command
     */
    public function handle(CommandInterface $command)
    {
    }
}
