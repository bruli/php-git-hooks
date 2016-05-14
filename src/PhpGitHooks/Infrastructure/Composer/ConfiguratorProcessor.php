<?php

namespace PhpGitHooks\Infrastructure\Composer;

use Composer\IO\IOInterface;
use PhpGitHooks\Application\Composer\CommitMsgProcessor;
use PhpGitHooks\Application\Composer\PreCommitProcessor;
use PhpGitHooks\Application\Composer\PrePushProcessor;
use PhpGitHooks\Infrastructure\Disk\Config\ConfigFileReaderInterface;
use PhpGitHooks\Infrastructure\Disk\Config\ConfigFileWriterInterface;
use PhpGitHooks\Infrastructure\Git\HooksFileCopier;

final class ConfiguratorProcessor
{
    /**
     * @var IOInterface
     */
    private $IO;
    /**
     * @var ConfigFileReaderInterface
     */
    private $configFileReader;
    /**
     * @var PreCommitProcessor
     */
    private $preCommitProcessor;
    /**
     * @var CommitMsgProcessor
     */
    private $commitMsgProcessor;
    /**
     * @var ConfigFileWriterInterface
     */
    private $configFileWriter;
    /** @var  HooksFileCopier */
    private $hookFileCopier;
    /**
     * @var PrePushProcessor
     */
    private $prePushProcessor;

    /**
     * @param ConfigFileReaderInterface $configFileReader
     * @param PreCommitProcessor        $preCommitProcessor
     * @param CommitMsgProcessor        $commitMsgProcessor
     * @param ConfigFileWriterInterface $configFileWriter
     * @param HooksFileCopier           $hooksFileCopier
     * @param PrePushProcessor          $prePushProcessor
     */
    public function __construct(
        ConfigFileReaderInterface $configFileReader,
        PreCommitProcessor $preCommitProcessor,
        CommitMsgProcessor $commitMsgProcessor,
        ConfigFileWriterInterface $configFileWriter,
        HooksFileCopier $hooksFileCopier,
        PrePushProcessor $prePushProcessor
    ) {
        $this->configFileReader = $configFileReader;
        $this->preCommitProcessor = $preCommitProcessor;
        $this->commitMsgProcessor = $commitMsgProcessor;
        $this->configFileWriter = $configFileWriter;
        $this->hookFileCopier = $hooksFileCopier;
        $this->prePushProcessor = $prePushProcessor;
    }

    /**
     * @param IOInterface $iOInterface
     */
    public function setIO(IOInterface $iOInterface)
    {
        $this->IO = $iOInterface;
    }

    public function process()
    {
        $configData = $this->configFileReader->getFileContents();
        $preCommitConfig = $this->preCommit($configData);
        $this->copyHook('pre-commit', $preCommitConfig['pre-commit']['enabled']);

        $commitMsgConfig = $this->commitMsg($configData);
        $this->copyHook('commit-msg', $commitMsgConfig['commit-msg']['enabled']);

        $prePushConfig = $this->prePush($configData);
        $this->copyHook('pre-push', $prePushConfig['pre-push']['enabled']);

        $merge['pre-commit'] = $preCommitConfig['pre-commit'];
        $merge['commit-msg'] = $commitMsgConfig['commit-msg'];
        $merge['pre-push'] = $prePushConfig['pre-push'];

        $this->configFileWriter->write($merge);
    }

    /**
     * @param array $configData
     *
     * @return array
     */
    private function preCommit(array $configData)
    {
        $this->preCommitProcessor->setIO($this->IO);

        return $this->preCommitProcessor->execute($configData);
    }

    /**
     * @param array $configData
     *
     * @return array
     */
    private function commitMsg(array $configData)
    {
        $this->commitMsgProcessor->setIO($this->IO);

        return $this->commitMsgProcessor->execute($configData);
    }

    /**
     * @param string $hook
     * @param bool   $enabled
     */
    private function copyHook($hook, $enabled)
    {
        $this->hookFileCopier->copy($hook, $enabled);
    }

    /**
     * @param $configData
     *
     * @return array
     */
    private function prePush($configData)
    {
        $this->prePushProcessor->setIO($this->IO);

        return $this->prePushProcessor->execute($configData);
    }
}
