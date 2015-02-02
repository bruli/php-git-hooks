<?php

namespace PhpGitHooks\Infrastructure\Common;

/**
 * Class FilesValidatorDummy
 * @package PhpGitHooks\Tests\Infrastructure\Common
 */
class InMemoryFilesValidator implements FilesValidatorInterface
{
    /** @var  bool */
    private $existsFile;

    public function __construct($existsFile)
    {
        $this->existsFile = $existsFile;
    }

    /**
     * @param array $files
     */
    public function setFiles(array $files)
    {
    }

    /**
     * @return bool
     */
    public function validate()
    {
        return $this->existsFile;
    }
}
