<?php

namespace PhpGitHooks\Module\Configuration\Contract\Command;

use Bruli\EventBusBundle\CommandBus\CommandHandlerInterface;
use Bruli\EventBusBundle\CommandBus\CommandInterface;
use Composer\IO\IOInterface;
use PhpGitHooks\Module\Configuration\Domain\CommitMsg;
use PhpGitHooks\Module\Configuration\Domain\Config;
use PhpGitHooks\Module\Configuration\Domain\PreCommit;
use PhpGitHooks\Module\Configuration\Domain\PrePush;
use PhpGitHooks\Module\Configuration\Infrastructure\Hook\HookCopier;
use PhpGitHooks\Module\Configuration\Model\ConfigurationFileReaderInterface;
use PhpGitHooks\Module\Configuration\Model\ConfigurationFileWriterInterface;
use PhpGitHooks\Module\Configuration\Service\CommitMsgProcessor;
use PhpGitHooks\Module\Configuration\Service\ConfigurationArrayTransformer;
use PhpGitHooks\Module\Configuration\Service\PreCommitProcessor;
use PhpGitHooks\Module\Configuration\Service\PrePushProcessor;

class ConfigurationProcessorHandler implements CommandHandlerInterface
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
     * @var PrePushProcessor
     */
    private $prePushProcessor;

    /**
     * ConfigurationProcessor constructor.
     *
     * @param ConfigurationFileReaderInterface $configurationFileReader
     * @param PreCommitProcessor               $preCommitProcessor
     * @param CommitMsgProcessor               $commitMsgProcessor
     * @param ConfigurationFileWriterInterface $configurationFileWriter
     * @param HookCopier                       $hookCopier
     * @param PrePushProcessor                 $prePushProcessor
     */
    public function __construct(
        ConfigurationFileReaderInterface $configurationFileReader,
        PreCommitProcessor $preCommitProcessor,
        CommitMsgProcessor $commitMsgProcessor,
        ConfigurationFileWriterInterface $configurationFileWriter,
        HookCopier $hookCopier,
        PrePushProcessor $prePushProcessor
    ) {
        $this->preCommitProcessor = $preCommitProcessor;
        $this->commitMsgProcessor = $commitMsgProcessor;
        $this->configurationFileWriter = $configurationFileWriter;
        $this->hookCopier = $hookCopier;
        $this->configurationFileReader = $configurationFileReader;
        $this->prePushProcessor = $prePushProcessor;
    }

    /**
     * @param IOInterface $input
     */
    private function process(IOInterface $input)
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

        $prePush = $this->prePushProcess($configData);

        if (true === $prePush->isEnabled()) {
            $this->hookCopier->copyPrePushHook();
        }

        $configArray = ConfigurationArrayTransformer::transform($preCommit, $commitMsg, $prePush);

        $this->configurationFileWriter->write($configArray);
    }

    /**
     * @param Config $configData
     *
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
     *
     * @return CommitMsg
     */
    private function commitMsgProcess(Config $configData)
    {
        /** @var CommitMsg $commitMsgData */
        $commitMsgData = $configData->getCommitMsg();

        return $this->commitMsgProcessor->process($commitMsgData, $this->io);
    }

    /**
     * @param Config $configData
     *
     * @return PrePush
     */
    private function prePushProcess(Config $configData)
    {
        /** @var PrePush $prePush */
        $prePush = $configData->getPrePush();

        return $this->prePushProcessor->process($prePush, $this->io);
    }

    /**
     * @param CommandInterface|ConfigurationProcessor $command
     */
    public function handle(CommandInterface $command)
    {
        $this->process($command->getInput());
    }
}
