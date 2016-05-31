<?php

namespace Module\Configuration\Service;

use Composer\IO\IOInterface;
use Module\Configuration\Domain\CommitMsg;

class CommitMsgProcessor
{
    /**
     * @var IOInterface
     */
    private $io;

    /**
     * @param CommitMsg   $commitMsgData
     * @param IOInterface $io
     *
     * @return CommitMsg
     */
    public function process(CommitMsg $commitMsgData, IOInterface $io)
    {
        $this->io = $io;

        if (true === $commitMsgData->isUndefined()) {
            $commitMsgData = CommitMsgConfigurator::configure($this->io, $commitMsgData);
        }

        return $commitMsgData;
    }
}
