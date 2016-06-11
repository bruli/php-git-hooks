<?php

namespace Module\Git\Contract\CommandHandler;

use Infrastructure\CommandBus\CommandHandlerInterface;
use Infrastructure\CommandBus\CommandInterface;
use Module\Git\Service\PreCommitTool;

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
