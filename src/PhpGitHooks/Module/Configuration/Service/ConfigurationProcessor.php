<?php

namespace PhpGitHooks\Module\Configuration\Service;

use Composer\IO\IOInterface;
use PhpGitHooks\Module\Configuration\Domain\CommitMsg;
use PhpGitHooks\Module\Configuration\Domain\Config;
use PhpGitHooks\Module\Configuration\Domain\PreCommit;
use PhpGitHooks\Module\Configuration\Infrastructure\Hook\HookCopier;
use PhpGitHooks\Module\Configuration\Model\ConfigurationFileReaderInterface;
use PhpGitHooks\Module\Configuration\Model\ConfigurationFileWriterInterface;

class ConfigurationProcessor
{
    /**
     * @var IOInterface
     */
    private $io;
    /**
     * @var PreCommitProcessor
     */
    private $preCommitProcessor;
    /**
     * @var CommitMsgProcessor
     */
    private $commitMsgProcessor;
    /**
     * @var ConfigurationFileWriterInterface
     */
    private $configurationFileWriter;
    /**
     * @var HookCopier
     */
    private $hookCopier;
    /**
     * @var ConfigurationFileReaderInterface
     */
    private $configurationFileReader;

    /**
     * ConfigurationProcessor constructor.
     *
     * @param ConfigurationFileReaderInterface $configurationFileReader
     * @param PreCommitProcessor $preCommitProcessor
     * @param CommitMsgProcessor $commitMsgProcessor
     * @param ConfigurationFileWriterInterface $configurationFileWriter
     * @param HookCopier $hookCopier
     */
    public function __construct(
        ConfigurationFileReaderInterface $configurationFileReader,
        PreCommitProcessor $preCommitProcessor,
        CommitMsgProcessor $commitMsgProcessor,
        ConfigurationFileWriterInterface $configurationFileWriter,
        HookCopier $hookCopier
    ) {
        $this->preCommitProcessor = $preCommitProcessor;
        $this->commitMsgProcessor = $commitMsgProcessor;
        $this->configurationFileWriter = $configurationFileWriter;
        $this->hookCopier = $hookCopier;
        $this->configurationFileReader = $configurationFileReader;
    }

    /**
     * @param IOInterface $input
     */
    public function process(IOInterface $input)
    {
        $this->io = $input;

        $configData = $this->configurationFileReader->getData();
        $preCommit = $this->preCommitProcess($configData);

        if (true === $preCommit->isEnabled()) {
            $this->hookCopier->copyPreCommitHook();
        }

        $commitMsg = $this->commitMsgProcess($configData);

        if (true === $commitMsg->isEnabled()) {
            $this->hookCopier->copyCommitMsgHook();
        }

        $configArray = ConfigurationArrayTransformer::transform($preCommit, $commitMsg);

        $this->configurationFileWriter->write($configArray);
    }

    /**
     * @param Config $configData
     * @return PreCommit
     */
    private function preCommitProcess(Config $configData)
    {
        /**  @var PreCommit $preCommitData */
        $preCommitData = $configData->getPreCommit();

        return $this->preCommitProcessor->process($preCommitData, $this->io);
    }

    /**
     * @param Config $configData
     * @return CommitMsg
     */
    private function commitMsgProcess(Config $configData)
    {
        /** @var CommitMsg $commitMsgData */
        $commitMsgData = $configData->getCommitMsg();

        return $this->commitMsgProcessor->process($commitMsgData, $this->io);
    }
}
