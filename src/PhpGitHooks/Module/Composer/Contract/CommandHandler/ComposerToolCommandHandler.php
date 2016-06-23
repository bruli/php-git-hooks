<?php

namespace PhpGitHooks\Module\Composer\Contract\CommandHandler;

use CommandBus\CommandBus\CommandHandlerInterface;
use CommandBus\CommandBus\CommandInterface;
use PhpGitHooks\Module\Composer\Contract\Command\ComposerToolCommand;
use PhpGitHooks\Module\Composer\Service\ComposerTool;

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
