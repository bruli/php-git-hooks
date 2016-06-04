<?php

namespace Module\Git\Contract\CommandHandler;

use Module\Git\Contract\Command\PreCommitToolCommand;
use Module\Git\Service\PreCommitTool;

class PreCommitToolCommandHandler
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
     * @param PreCommitToolCommand $preCommitToolCommand
     */
    public function handle(PreCommitToolCommand $preCommitToolCommand)
    {
        $this->preCommitTool->execute($preCommitToolCommand->getOutputInterface());
    }
}
