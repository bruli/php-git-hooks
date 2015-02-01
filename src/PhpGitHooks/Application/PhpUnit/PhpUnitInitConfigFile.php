<?php

namespace PhpGitHooks\Application\PhpUnit;

use PhpGitHooks\Application\Composer\Processor;
use PhpGitHooks\Infrastructure\Common\ConfigFileToolValidator;
use PhpGitHooks\Infrastructure\Common\FileCreatorInterface;
use PhpGitHooks\Infrastructure\Common\FilesValidatorInterface;
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
     * @param FilesValidatorInterface $configFileToolValidator
     * @param FileCreatorInterface    $phpUnitConfigFileCreator
     */
    public function __construct(
        FilesValidatorInterface $configFileToolValidator,
        FileCreatorInterface $phpUnitConfigFileCreator
    ) {
        $this->validatorFile = $configFileToolValidator;
        $this->validatorFile->setFiles($this->configFiles);
        $this->phpunitConfigFileCreator = $phpUnitConfigFileCreator;
    }

    public function process()
    {
        if (!$this->validatorFile->validate()) {
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
