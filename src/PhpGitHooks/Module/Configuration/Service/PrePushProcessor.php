<?php

namespace PhpGitHooks\Module\Configuration\Service;

use Composer\IO\IOInterface;
use PhpGitHooks\Module\Configuration\Domain\Execute;
use PhpGitHooks\Module\Configuration\Domain\PrePush;
use PhpGitHooks\Module\Configuration\Model\ExecuteInterface;

class PrePushProcessor
{
    /**
     * @var IOInterface
     */
    private $input;

    /**
     * @param PrePush     $prePushData
     * @param IOInterface $input
     *
     * @return PrePush
     */
    public function process(PrePush $prePushData, IOInterface $input)
    {
        $this->input = $input;
        if (true === $prePushData->isUndefined()) {
            $prePushData = PrePushConfigurator::configure($this->input, $prePushData);
        }

        if (true === $prePushData->isEnabled()) {
            $prePushData = $prePushData->setExecute($this->configTools($prePushData->getExecute()));
        }

        return $prePushData;
    }

    /**
     * @param ExecuteInterface $execute
     *
     * @return Execute
     */
    protected function configTools(ExecuteInterface $execute)
    {
        $tools = $execute->execute();

        $tools[0] = PhpUnitConfigurator::configure($this->input, $tools[0]);
        $tools[1] = PhpUnitStrictCoverageConfigurator::configure($this->input, $tools[1]);
        $tools[2] = PhpUnitGuardCoverageConfigurator::configure($this->input, $tools[2]);
        
        return new  Execute($tools);
    }
}
