<?php

namespace Module\Git\Contract\CommandHandler;

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

    public function handle()
    {
        $this->preCommitTool->execute();
    }
}
