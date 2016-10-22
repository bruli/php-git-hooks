<?php

namespace PhpGitHooks\Module\PhpUnit\Contract\CommandHandler;

use Bruli\EventBusBundle\CommandBus\CommandHandlerInterface;
use Bruli\EventBusBundle\CommandBus\CommandInterface;
use PhpGitHooks\Module\PhpUnit\Contract\Command\PhpUnitToolCommand;
use PhpGitHooks\Module\PhpUnit\Service\PhpUnitToolExecutor;

class PhpUnitToolCommandHandler implements CommandHandlerInterface
{
    /**
     * @var PhpUnitToolExecutor
     */
    private $phpUnitToolExecutor;

    /**
     * PhpUnitToolCommandHandler constructor.
     *
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
