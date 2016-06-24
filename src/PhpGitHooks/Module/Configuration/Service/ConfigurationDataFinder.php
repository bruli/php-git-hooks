<?php

namespace PhpGitHooks\Module\Configuration\Service;

use PhpGitHooks\Infrastructure\CommandBus\QueryBus\QueryInterface;
use PhpGitHooks\Module\Configuration\Contract\Response\ConfigurationDataResponse;
use PhpGitHooks\Module\Configuration\Domain\CommitMsg;
use PhpGitHooks\Module\Configuration\Domain\Config;
use PhpGitHooks\Module\Configuration\Domain\PhpCs;
use PhpGitHooks\Module\Configuration\Domain\PhpCsFixer;
use PhpGitHooks\Module\Configuration\Domain\PhpMd;
use PhpGitHooks\Module\Configuration\Domain\PhpUnit;
use PhpGitHooks\Module\Configuration\Domain\PhpUnitStrictCoverage;
use PhpGitHooks\Module\Configuration\Domain\PreCommit;
use PhpGitHooks\Module\Configuration\Domain\PrePush;
use PhpGitHooks\Module\Configuration\Model\ConfigurationFileReaderInterface;

class ConfigurationDataFinder implements QueryInterface
{
    /**
     * @var ConfigurationFileReaderInterface
     */
    private $configurationFileReader;

    /**
     * ConfigurationDataFinder constructor.
     *
     * @param ConfigurationFileReaderInterface $configurationFileReader
     */
    public function __construct(ConfigurationFileReaderInterface $configurationFileReader)
    {
        $this->configurationFileReader = $configurationFileReader;
    }

    /**
     * @return ConfigurationDataResponse
     */
    public function find()
    {
        $data = $this->configurationFileReader->getData();

        return $this->getConfigurationDataResponse($data);
    }

    private function getConfigurationDataResponse(Config $data)
    {
        /** @var PreCommit $preCommit */
        $preCommit = $data->getPreCommit();
        /** @var CommitMsg $commitMsg */
        $commitMsg = $data->getCommitMsg();
        $tools = $preCommit->getExecute()->execute();
        /** @var PrePush $prePush */
        $prePush = $data->getPrePush();
        $prePushTools = $prePush->getExecute()->execute();

        $composer = $tools[0];
        $jsonLint = $tools[1];
        $phpLint = $tools[2];
        /** @var PhpMd $phpMd */
        $phpMd = $tools[3];
        /** @var PhpCs $phpCs */
        $phpCs = $tools[4];
        /** @var PhpCsFixer $phpCsFixer */
        $phpCsFixer = $tools[5];
        /** @var PhpUnit $phpUnit */
        $phpUnit = $tools[6];
        /** @var PhpUnitStrictCoverage $phpUnitStrictCoverage */
        $phpUnitStrictCoverage = $tools[7];
        /** @var PhpUnit $prePushPhpUnit */
        $prePushPhpUnit = $prePushTools[0];
        /** @var PhpUnitStrictCoverage $prePushStrictCoverage */
        $prePushStrictCoverage = $prePushTools[1];

        return ConfigurationDataResponseFactory::build(
            $preCommit,
            $composer,
            $jsonLint,
            $phpLint,
            $phpMd,
            $phpCs,
            $phpCsFixer,
            $phpUnit,
            $phpUnitStrictCoverage,
            $commitMsg,
            $prePush,
            $prePushPhpUnit,
            $prePushStrictCoverage
        );
    }
}
