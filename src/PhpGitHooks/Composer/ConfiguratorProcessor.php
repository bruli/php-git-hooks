<?php

namespace PhpGitHooks\Composer;

use PhpGitHooks\Infraestructure\Config\CheckConfigFile;
use PhpGitHooks\Infraestructure\Config\ConfigFileWriter;
use PhpGitHooks\Infraestructure\PhpUnit\PhpUnitInitConfigFile;

/**
 * Class ConfiguratorProcessor
 * @package PhpGitHooks\Composer
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

    /**
     * @param CheckConfigFile       $checkConfigFile
     * @param PreCommitProcessor    $preCommitProcessor
     * @param ConfigFileWriter      $configFileWriter
     * @param PhpUnitInitConfigFile $phpUnitInitConfigFile
     */
    public function __construct(
        CheckConfigFile $checkConfigFile,
        PreCommitProcessor $preCommitProcessor,
        ConfigFileWriter $configFileWriter,
        PhpUnitInitConfigFile $phpUnitInitConfigFile
    ) {
        $this->checkConfigFile = $checkConfigFile;
        $this->preCommitProcessor = $preCommitProcessor;
        $this->configFileWriter = $configFileWriter;
        $this->phpUnitInitConfigFile = $phpUnitInitConfigFile;
    }

    public function process()
    {
        $this->initConfigFile();
        $this->phpUnitInitConfigFile->setIO($this->io);
        $this->phpUnitInitConfigFile->process();
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

            $this->configFileWriter->write($this->checkConfigFile->getFile(), $this->configData);
        }
    }
}
