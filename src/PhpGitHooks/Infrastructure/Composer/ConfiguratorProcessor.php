<?php

namespace PhpGitHooks\Infrastructure\Composer;

use Composer\IO\IOInterface;
use PhpGitHooks\Application\Composer\CommitMsgProcessor;
use PhpGitHooks\Application\Composer\PreCommitProcessor;
use PhpGitHooks\Infrastructure\Disk\Config\ConfigFileReaderInterface;
use PhpGitHooks\Infrastructure\Disk\Config\ConfigFileWriterInterface;

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

    /**
     * @param ConfigFileReaderInterface $configFileReader
     * @param PreCommitProcessor        $preCommitProcessor
     * @param CommitMsgProcessor        $commitMsgProcessor
     * @param ConfigFileWriterInterface $configFileWriter
     */
    public function __construct(
        ConfigFileReaderInterface $configFileReader,
        PreCommitProcessor $preCommitProcessor,
        CommitMsgProcessor $commitMsgProcessor,
        ConfigFileWriterInterface $configFileWriter
    ) {
        $this->configFileReader = $configFileReader;
        $this->preCommitProcessor = $preCommitProcessor;
        $this->commitMsgProcessor = $commitMsgProcessor;
        $this->configFileWriter = $configFileWriter;
    }

    /**
     * @param IOInterface $IOInterface
     */
    public function setIO(IOInterface $IOInterface)
    {
        $this->IO = $IOInterface;
    }

    public function process()
    {
        $configData = $this->configFileReader->getFileContents();
        $preCommitConfig = $this->preCommit($configData);

        $commitMsgConfig = $this->commitMsg($configData);

        $merge['pre-commit'] = $preCommitConfig['pre-commit'];
        $merge['commit-msg'] = $commitMsgConfig['commit-msg'];

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
}
