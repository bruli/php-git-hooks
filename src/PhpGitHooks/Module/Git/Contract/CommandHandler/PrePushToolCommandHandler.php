<?php

namespace PhpGitHooks\Module\Git\Contract\CommandHandler;

use PhpGitHooks\Infrastructure\CommandBus\CommandBus\CommandHandlerInterface;
use PhpGitHooks\Infrastructure\CommandBus\CommandBus\CommandInterface;
use PhpGitHooks\Module\Git\Contract\Command\PrePushToolCommand;
use PhpGitHooks\Module\Git\Service\PrePushTool;

class PrePushToolCommandHandler implements CommandHandlerInterface
{
    /**
     * @var PrePushTool
     */
    private $prePushTool;

    /**
     * PrePushToolCommandHandler constructor.
     *
     * @param PrePushTool $prePushTool
     */
    public function __construct(PrePushTool $prePushTool)
    {
        $this->prePushTool = $prePushTool;
    }

    /**
     * @param CommandInterface|PrePushToolCommand $command
     */
    public function handle(CommandInterface $command)
    {
        $this->prePushTool->execute($command->getRemote(), $command->getUrl());
    }
}
