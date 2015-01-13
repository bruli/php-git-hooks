<?php

namespace PhpGitHooks\Composer;

use Composer\IO\IOInterface;
use PhpGitHooks\Infraestructure\Config\CheckConfigFile;
use PhpGitHooks\Infraestructure\Config\ConfigFileWriter;

class ConfiguratorProcessor extends Processor
{
    private $configData = array();
    /** @var  CheckConfigFile */
    private $checkConfigFile;

    /**
     * @param CheckConfigFile $checkConfigFile
     */
    public function __construct(CheckConfigFile $checkConfigFile)
    {
        $this->checkConfigFile = $checkConfigFile;
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

            $preCommit = new PreCommitProcessor();
            $preCommit->setIO($this->io);
            $this->configData = $preCommit->execute();

            ConfigFileWriter::write($this->checkConfigFile->getFile(), $this->configData);
        }
    }
}
