<?php


namespace PhpGitHooks\Infraestructure\PhpUnit;

use PhpGitHooks\Composer\Processor;

/**
 * Class PhpUnitInitConfigFile
 * @package PhpGitHooks\Infraestructure\PhpUnit
 */
class PhpUnitInitConfigFile extends Processor
{
    /** @var  PhpUnitFileValidator */
    private $validatorFile;

    /**
     * @param PhpUnitFileValidator $phpUnitFileValidator
     */
    public function __construct(PhpUnitFileValidator $phpUnitFileValidator)
    {
        $this->validatorFile = $phpUnitFileValidator;
    }

    public function process()
    {
        if (!$this->validatorFile->existsConfigFile()) {
            $this->createFile();
        }
    }

    private function createFile()
    {
        $answer = $this->setQuestion('Do you want create a phpunit.xml.dist file?', 'Y/n', 'Y');

        if ('Y' === strtoupper($answer)) {
            copy(__DIR__ . '/../../../../phpunit.xml.dist', 'phpunit.xml.dist');
        }
    }
}