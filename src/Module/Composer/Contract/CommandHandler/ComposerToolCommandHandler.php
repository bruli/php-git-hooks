<?php

namespace Module\Composer\Contract\CommandHandler;

use Infrastructure\CommandBus\CommandHandlerInterface;
use Infrastructure\CommandBus\CommandInterface;
use Module\Composer\Contract\Command\ComposerToolCommand;
use Module\Composer\Service\ComposerTool;

class ComposerToolCommandHandler implements CommandHandlerInterface
{
    /**
     * @var ComposerTool
     */
    private $composerTool;

    /**
     * ComposerToolCommandHandler constructor.
     *
     * @param ComposerTool $composerTool
     */
    public function __construct(ComposerTool $composerTool)
    {
        $this->composerTool = $composerTool;
    }

    /**
     * @param CommandInterface|ComposerToolCommand $command
     */
    public function handle(CommandInterface $command)
    {
        $this->composerTool->execute($command->getFiles(), $command->getErrorMessage());
    }
}
