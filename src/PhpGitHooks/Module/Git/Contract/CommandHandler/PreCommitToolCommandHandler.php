<?php

namespace PhpGitHooks\Module\Git\Contract\CommandHandler;

use Bruli\EventBusBundle\CommandBus\CommandHandlerInterface;
use Bruli\EventBusBundle\CommandBus\CommandInterface;
use PhpGitHooks\Module\Git\Service\PreCommitTool;

class PreCommitToolCommandHandler implements CommandHandlerInterface
{
    /**
     * @var PreCommitTool
     */
    private $preCommitTool;

    /**
     * PreCommitToolCommandHandler constructor.
     *
     * @param PreCommitTool $preCommitTool
     */
    public function __construct(PreCommitTool $preCommitTool)
    {
        $this->preCommitTool = $preCommitTool;
    }

    /**
     * @param CommandInterface $command
     */
    public function handle(CommandInterface $command)
    {
        $this->preCommitTool->execute();
    }
}
