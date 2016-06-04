<?php

namespace Module\Composer\Contract\CommandHandler;

use Module\Composer\Contract\Command\ComposerToolCommand;
use Module\Composer\Service\ComposerTool;

class ComposerToolCommandHandler
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
     * @param ComposerToolCommand $composerToolCommand
     */
    public function handle(ComposerToolCommand $composerToolCommand)
    {
        $this->composerTool->execute($composerToolCommand->getFiles());
    }
}
