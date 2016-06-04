<?php

namespace Module\Configuration\Contract\QueryHandler;

use Module\Configuration\Contract\Response\ConfigurationDataResponse;
use Module\Configuration\Domain\CommitMsg;
use Module\Configuration\Domain\PhpCs;
use Module\Configuration\Domain\PhpCsFixer;
use Module\Configuration\Domain\PhpUnit;
use Module\Configuration\Domain\PreCommit;
use Module\Configuration\Service\ConfigurationDataFinder;

class ConfigurationDataFinderQueryHandler
{
    /**
     * @var ConfigurationDataFinder
     */
    private $configurationDataFinder;

    /**
     * ConfigurationDataFinderQueryHandler constructor.
     *
     * @param ConfigurationDataFinder $configurationDataFinder
     */
    public function __construct(ConfigurationDataFinder $configurationDataFinder)
    {
        $this->configurationDataFinder = $configurationDataFinder;
    }

    /**
     * @return ConfigurationDataResponse
     */
    public function handle()
    {
        $data = $this->configurationDataFinder->find();

        /** @var PreCommit $preCommit */
        $preCommit = $data->getPreCommit();
        /** @var CommitMsg $commitMsg */
        $commitMsg = $data->getCommitMsg();
        $tools = $preCommit->getExecute()->execute();

        $composer = $tools[0];
        $jsonLint = $tools[1];
        $phpLint = $tools[2];
        $phpMd = $tools[3];
        /** @var PhpCs $phpCs */
        $phpCs = $tools[4];
        /** @var PhpCsFixer $phpCsFixer */
        $phpCsFixer = $tools[5];
        /** @var PhpUnit $phpUnit */
        $phpUnit = $tools[6];

        return new ConfigurationDataResponse(
            $preCommit->isEnabled(),
            $preCommit->getMessages()->getRightMessage()->value(),
            $preCommit->getMessages()->getErrorMessage()->value(),
            $composer->isEnabled(),
            $jsonLint->isEnabled(),
            $phpLint->isEnabled(),
            $phpMd->isEnabled(),
            $phpCs->isEnabled(),
            $phpCs->getStandard()->value(),
            $phpCsFixer->isEnabled(),
            $phpCsFixer->getLevels()->getPsr0()->value(),
            $phpCsFixer->getLevels()->getPsr1()->value(),
            $phpCsFixer->getLevels()->getPsr2()->value(),
            $phpCsFixer->getLevels()->getSymfony()->value(),
            $phpUnit->isEnabled(),
            $phpUnit->getRandomMode()->value(),
            $phpUnit->getOptions()->value(),
            $commitMsg->isEnabled(),
            $commitMsg->getRegularExpression()->value()
        );
    }
}
