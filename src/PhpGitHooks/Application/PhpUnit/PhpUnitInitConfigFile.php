<?php

namespace PhpGitHooks\Application\PhpUnit;

use PhpGitHooks\Application\Composer\Processor;
use PhpGitHooks\Infrastructure\Common\ConfigFileToolValidator;
use PhpGitHooks\Infrastructure\Common\FileCreator;
use PhpGitHooks\Infrastructure\Common\FilesValidator;
use PhpGitHooks\Infrastructure\PhpUnit\PhpUnitConfigFileCreator;

/**
 * Class PhpUnitInitConfigFile
 * @package PhpGitHooks\Infrastructure\PhpUnit
 */
class PhpUnitInitConfigFile extends Processor
{
    /** @var  ConfigFileToolValidator */
    private $validatorFile;

    private $configFiles = ['phpunit.xml', 'phpunit.xml.dist'];
    /** @var  PhpUnitConfigFileCreator */
    private $phpunitConfigFileCreator;

    /**
     * @param FilesValidator    $configFileToolValidator
     * @param ConfigFileCreator $phpUnitConfigFileCreator
     */
    public function __construct(
        FilesValidator $configFileToolValidator,
        FileCreator $phpUnitConfigFileCreator
    ) {
        $this->validatorFile = $configFileToolValidator;
        $this->validatorFile->setFiles($this->configFiles);
        $this->phpunitConfigFileCreator = $phpUnitConfigFileCreator;
    }

    public function process()
    {
        if (!$this->validatorFile->existsFile()) {
            $this->createFile();
        }
    }

    private function createFile()
    {
        $answer = $this->setQuestion('Do you want create a phpunit.xml.dist file?', 'Y/n', 'Y');

        if ('Y' === strtoupper($answer)) {
            $this->phpunitConfigFileCreator->create();
        }
    }
}
