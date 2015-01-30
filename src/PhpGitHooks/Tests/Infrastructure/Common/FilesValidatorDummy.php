<?php

namespace PhpGitHooks\Tests\Infrastructure\Common;

use PhpGitHooks\Infrastructure\Common\FilesValidator;

/**
 * Class FilesValidatorDummy
 * @package PhpGitHooks\Tests\Infrastructure\Common
 */
class FilesValidatorDummy implements FilesValidator
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
        // TODO: Implement setFiles() method.
    }

    /**
     * @return bool
     */
    public function existsFile()
    {
        return $this->existsFile;
    }
}
