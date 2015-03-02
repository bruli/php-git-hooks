<?php

namespace PhpGitHooks\Application\Composer;

use PhpGitHooks\Infrastructure\Common\CheckFileInterface;
use PhpGitHooks\Infrastructure\Common\FileWriterInterface;
use PhpGitHooks\Infrastructure\Config\CheckConfigFile;
use PhpGitHooks\Infrastructure\Config\ConfigFileWriter;
use PhpGitHooks\Application\PhpUnit\PhpUnitInitConfigFile;

/**
 * Class ConfiguratorProcessor.
 */
class ConfiguratorProcessor extends Processor
{
    private $configData = array();
    /** @var  CheckConfigFile */
    private $checkConfigFile;
    /** @var PreCommitProcessor */
    private $preCommitProcessor;
    /** @var ConfigFileWriter */
    private $configFileWriter;
    /** @var PhpUnitInitConfigFile  */
    private $phpUnitInitConfigFile;
    /** @var  CommitMsgProcessor */
    private $commitMsgProcessor;

    /**
     * @param CheckFileInterface    $checkConfigFile
     * @param PreCommitProcessor    $preCommitProcessor
     * @param FileWriterInterface   $configFileWriter
     * @param PhpUnitInitConfigFile $phpUnitInitConfigFile
     * @param CommitMsgProcessor    $commitMsgProcessor
     */
    public function __construct(
        CheckFileInterface $checkConfigFile,
        PreCommitProcessor $preCommitProcessor,
        FileWriterInterface $configFileWriter,
        PhpUnitInitConfigFile $phpUnitInitConfigFile,
        CommitMsgProcessor $commitMsgProcessor
    ) {
        $this->checkConfigFile = $checkConfigFile;
        $this->preCommitProcessor = $preCommitProcessor;
        $this->configFileWriter = $configFileWriter;
        $this->phpUnitInitConfigFile = $phpUnitInitConfigFile;
        $this->commitMsgProcessor = $commitMsgProcessor;
    }

    /**
     * @return bool
     */
    public function process()
    {
        $this->initConfigFile();
        $this->phpUnitInitConfigFile->setIO($this->io);
        $this->phpUnitInitConfigFile->process();

        return true;
    }

    /**
     */
    private function initConfigFile()
    {
        if (false === $this->checkConfigFile->exists()) {
            $generate = $this->setQuestion('Do you want generate a php-git.hooks.yml file?', 'Y/n', 'Y');

            if ('N' === strtoupper($generate)) {
                $this->io->write(
                    '<error>Remember that you need a configuration file to use php-git-hooks library.</error>'
                );

                return;
            }

            $preCommitData = $this->preCommit();
            $commitMsgData = $this->commitMsg();

            $this->configData = array_merge($preCommitData, $commitMsgData);

            $this->configFileWriter->write($this->checkConfigFile->getFile(), $this->configData);
        }
    }

    /**
     * @return array
     */
    private function commitMsg()
    {
        $this->commitMsgProcessor->setIO($this->io);

        return $this->commitMsgProcessor->execute();
    }

    /**
     * @return array
     */
    private function preCommit()
    {
        $this->preCommitProcessor->setIO($this->io);

        return $this->preCommitProcessor->execute();
    }
}
