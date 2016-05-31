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
     * ConfigurationProcessor constructor.
     * @param ConfigurationDataFinder $configurationDataFinder
     * @param PreCommitProcessor $preCommitProcessor
     * @param CommitMsgProcessor $commitMsgProcessor
     */
    public function __construct(
        ConfigurationDataFinder $configurationDataFinder,
        PreCommitProcessor $preCommitProcessor,
        CommitMsgProcessor $commitMsgProcessor
    ) {
        $this->configurationDataFinder = $configurationDataFinder;
        $this->preCommitProcessor = $preCommitProcessor;
        $this->commitMsgProcessor = $commitMsgProcessor;
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
        ConfigurationFileWriter::write($configArray);
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
