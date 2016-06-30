<?php

namespace PhpGitHooks\Module\Configuration\Service;

use Composer\IO\IOInterface;
use PhpGitHooks\Module\Configuration\Domain\Execute;
use PhpGitHooks\Module\Configuration\Domain\PreCommit;
use PhpGitHooks\Module\Configuration\Model\ExecuteInterface;

class PreCommitProcessor
{
    /**
     * @var IOInterface
     */
    private $io;

    /**
     * @param PreCommit   $preCommitData
     * @param IOInterface $input
     *
     * @return PreCommit
     */
    public function process(PreCommit $preCommitData, IOInterface $input)
    {
        $this->io = $input;
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
        $tools[7] = PhpUnitStrictCoverageConfigurator::configure($this->io, $tools[7]);
        $tools[8] = PhpUnitGuardCoverageConfigurator::configure($this->io, $tools[8]);

        return new Execute($tools);
    }
}
