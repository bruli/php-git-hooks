<?php

namespace PhpGitHooks\Module\Configuration\Service;

use Composer\IO\IOInterface;
use PhpGitHooks\Module\Configuration\Domain\CommitMsg;
use PhpGitHooks\Module\Configuration\Domain\Config;
use PhpGitHooks\Module\Configuration\Domain\PreCommit;
use PhpGitHooks\Module\Configuration\Infrastructure\Hook\HookCopier;
use PhpGitHooks\Module\Configuration\Model\ConfigurationFileWriterInterface;

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
     * @var HookCopier
     */
    private $hookCopier;

    /**
     * ConfigurationProcessor constructor.
     *
     * @param ConfigurationDataFinder          $configurationDataFinder
     * @param PreCommitProcessor               $preCommitProcessor
     * @param CommitMsgProcessor               $commitMsgProcessor
     * @param ConfigurationFileWriterInterface $configurationFileWriter
     * @param HookCopier                       $hookCopier
     */
    public function __construct(
        ConfigurationDataFinder $configurationDataFinder,
        PreCommitProcessor $preCommitProcessor,
        CommitMsgProcessor $commitMsgProcessor,
        ConfigurationFileWriterInterface $configurationFileWriter,
        HookCopier $hookCopier
    ) {
        $this->configurationDataFinder = $configurationDataFinder;
        $this->preCommitProcessor = $preCommitProcessor;
        $this->commitMsgProcessor = $commitMsgProcessor;
        $this->configurationFileWriter = $configurationFileWriter;
        $this->hookCopier = $hookCopier;
    }

    /**
     * @param IOInterface $input
     */
    public function process(IOInterface $input)
    {
        $this->io = $input;

        //TODO, llamar al reader directamente en lugar del finder.
        $this->configData = $this->configurationDataFinder->find();
        $preCommit = $this->preCommitProcess();

        if (true === $preCommit->isEnabled()) {
            $this->hookCopier->copyPreCommitHook();
        }

        $commitMsg = $this->commitMsgProcess();

        if (true == $commitMsg->isEnabled()) {
            $this->hookCopier->copyCommitMsgHook();
        }

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
