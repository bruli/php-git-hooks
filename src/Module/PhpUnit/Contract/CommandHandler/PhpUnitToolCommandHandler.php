<?php

namespace Module\PhpUnit\Contract\CommandHandler;

use Infrastructure\CommandBus\CommandHandlerInterface;
use Infrastructure\CommandBus\CommandInterface;
use Module\PhpUnit\Contract\Command\PhpUnitToolCommand;
use Module\PhpUnit\Service\PhpUnitToolExecutor;

class PhpUnitToolCommandHandler implements CommandHandlerInterface
{
    /**
     * @var PhpUnitToolExecutor
     */
    private $phpUnitToolExecutor;

    /**
     * PhpUnitToolCommandHandler constructor.
     * @param PhpUnitToolExecutor $phpUnitToolExecutor
     */
    public function __construct(PhpUnitToolExecutor $phpUnitToolExecutor)
    {
        $this->phpUnitToolExecutor = $phpUnitToolExecutor;
    }

    /**
     * @param CommandInterface|PhpUnitToolCommand $command
     */
    public function handle(CommandInterface $command)
    {
        $this->phpUnitToolExecutor->execute(
            $command->isRandomMode(),
            $command->getOptions(),
            $command->getErrorMessage()
        );
    }
}
