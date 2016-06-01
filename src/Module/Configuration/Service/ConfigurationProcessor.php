<?php

namespace Module\Configuration\Service;

use Composer\IO\IOInterface;
use Module\Configuration\Domain\CommitMsg;
use Module\Configuration\Domain\Config;
use Module\Configuration\Domain\PreCommit;
use Module\Configuration\Infrastructure\Persistence\Disk\ConfigurationFileWriter;
use Module\Configuration\Model\ConfigurationFileWriterInterface;

class ConfigurationProcessor
{
    /**
     * @var IOInterface
     */
    private $io;
    /**
     * @var ConfigurationDataFinder
     */
    private $configurationDataFinder;
    /**
     * @var PreCommitProcessor
     */
    private $preCommitProcessor;
    /**
     * @var Config
     */
    private $configData;
    /**
     * @var CommitMsgProcessor
     */
    private $commitMsgProcessor;
    /**
     * @var ConfigurationFileWriterInterface
     */
    private $configurationFileWriter;

    /**
     * ConfigurationProcessor constructor.
     * @param ConfigurationDataFinder $configurationDataFinder
     * @param PreCommitProcessor $preCommitProcessor
     * @param CommitMsgProcessor $commitMsgProcessor
     * @param ConfigurationFileWriterInterface $configurationFileWriter
     */
    public function __construct(
        ConfigurationDataFinder $configurationDataFinder,
        PreCommitProcessor $preCommitProcessor,
        CommitMsgProcessor $commitMsgProcessor,
        ConfigurationFileWriterInterface $configurationFileWriter
    ) {
        $this->configurationDataFinder = $configurationDataFinder;
        $this->preCommitProcessor = $preCommitProcessor;
        $this->commitMsgProcessor = $commitMsgProcessor;
        $this->configurationFileWriter = $configurationFileWriter;
    }

    /**
     * @param IOInterface $IOInterface
     */
    public function process(IOInterface $IOInterface)
    {
        $this->io = $IOInterface;

        $this->configData = $this->configurationDataFinder->find();
        $preCommit = $this->preCommitProcess();
        $commitMsg = $this->commitMsgProcess();
        $configArray = ConfigurationArrayTransformer::transform($preCommit, $commitMsg);
        $this->configurationFileWriter->write($configArray);
    }

    /**
     * @return PreCommit
     */
    private function preCommitProcess()
    {
        /**  @var PreCommit $preCommitData */
        $preCommitData = $this->configData->getPreCommit();
        return $this->preCommitProcessor->process($preCommitData, $this->io);
    }

    /**
     * @return CommitMsg
     */
    private function commitMsgProcess()
    {
        /** @var CommitMsg $commitMsgData */
        $commitMsgData = $this->configData->getCommitMsg();
        return $this->commitMsgProcessor->process($commitMsgData, $this->io);
    }
}
