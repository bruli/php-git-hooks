<?php

namespace PhpGitHooks\Composer;

use PhpGitHooks\Infraestructure\Config\CheckConfigFile;
use PhpGitHooks\Infraestructure\Config\ConfigFileWriter;

class ConfiguratorProcessor extends Processor
{
    private $configData = array();
    /** @var  CheckConfigFile */
    private $checkConfigFile;
    /** @var PreCommitProcessor */
    private $preCommitProcessor;

    /**
     * @param CheckConfigFile $checkConfigFile
     * @param PreCommitProcessor $preCommitProcessor
     */
    public function __construct(
        CheckConfigFile $checkConfigFile,
        PreCommitProcessor $preCommitProcessor
    )
    {
        $this->checkConfigFile = $checkConfigFile;
        $this->preCommitProcessor = $preCommitProcessor;
    }

    public function process()
    {
        $this->initConfigFile();
    }

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

            $this->preCommitProcessor->setIO($this->io);
            $this->configData = $this->preCommitProcessor->execute();

            ConfigFileWriter::write($this->checkConfigFile->getFile(), $this->configData);
        }
    }
}
