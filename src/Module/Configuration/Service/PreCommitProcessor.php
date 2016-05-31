<?php

namespace Module\Configuration\Service;

use Composer\IO\IOInterface;
use Module\Configuration\Domain\Execute;
use Module\Configuration\Domain\PreCommit;
use Module\Configuration\Model\ExecuteInterface;

class PreCommitProcessor
{
    /**
     * @var IOInterface
     */
    private $io;

    /**
     * @param PreCommit   $preCommitData
     * @param IOInterface $IOInterface
     *
     * @return PreCommit
     */
    public function process(PreCommit $preCommitData, IOInterface $IOInterface)
    {
        $this->io = $IOInterface;
        if (true === $preCommitData->isUndefined()) {
            $preCommitData = PreCommitConfigurator::configure($this->io, $preCommitData);
        }

        if (true === $preCommitData->isEnabled()) {
            $preCommitData = $preCommitData->setExecute($this->configTools($preCommitData->getExecute()));
        }

        return $preCommitData;
    }

    /**
     * @param ExecuteInterface $execute
     *
     * @return ExecuteInterface
     */
    private function configTools(ExecuteInterface $execute)
    {
        $tools = $execute->execute();
        $tools[0] = ComposerConfigurator::configure($this->io, $tools[0]);
        $tools[1] = JsonLintConfigurator::configure($this->io, $tools[1]);
        $tools[2] = PhpLintConfigurator::configure($this->io, $tools[2]);
        $tools[3] = PhpMdConfigurator::configure($this->io, $tools[3]);
        $tools[4] = PhpCsConfigurator::configure($this->io, $tools[4]);
        $tools[5] = PhpCsFixerConfigurator::configure($this->io, $tools[5]);
        $tools[6] = PhpUnitConfigurator::configure($this->io, $tools[6]);

        return new Execute($tools);
    }
}
