<?php

namespace PhpGitHooks\Module\Configuration\Contract\QueryHandler;

use CommandBus\QueryBus\QueryHandlerInterface;
use CommandBus\QueryBus\QueryInterface;
use PhpGitHooks\Module\Configuration\Contract\Response\ConfigurationDataResponse;
use PhpGitHooks\Module\Configuration\Domain\CommitMsg;
use PhpGitHooks\Module\Configuration\Domain\PhpCs;
use PhpGitHooks\Module\Configuration\Domain\PhpCsFixer;
use PhpGitHooks\Module\Configuration\Domain\PhpUnit;
use PhpGitHooks\Module\Configuration\Domain\PreCommit;
use PhpGitHooks\Module\Configuration\Service\ConfigurationDataFinder;

class ConfigurationDataFinderQueryHandler implements QueryHandlerInterface
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
     * @param QueryInterface $query
     *
     * @return ConfigurationDataResponse
     */
    public function handle(QueryInterface $query)
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

        //TODO, ponerlo en el service
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
