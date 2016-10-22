<?php

namespace PhpGitHooks\Module\Git\Contract\CommandHandler;

use Bruli\EventBusBundle\CommandBus\CommandHandlerInterface;
use Bruli\EventBusBundle\CommandBus\CommandInterface;
use PhpGitHooks\Module\Git\Contract\Command\CommitMsgCommand;
use PhpGitHooks\Module\Git\Service\CommitMsgTool;

class CommitMsgCommandHandler implements CommandHandlerInterface
{
    /**
     * @var CommitMsgTool
     */
    private $commitMsgTool;

    /**
     * CommitMsgCommandHandler constructor.
     *
     * @param CommitMsgTool $commitMsgTool
     */
    public function __construct(CommitMsgTool $commitMsgTool)
    {
        $this->commitMsgTool = $commitMsgTool;
    }

    /**
     * @param CommandInterface|CommitMsgCommand $command
     */
    public function handle(CommandInterface $command)
    {
        $this->commitMsgTool->run($command->getInput());
    }
}
