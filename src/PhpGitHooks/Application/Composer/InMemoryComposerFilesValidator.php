<?php

namespace PhpGitHooks\Application\Composer;

use PhpGitHooks\Infrastructure\Common\FilesValidatorInterface;
use PhpGitHooks\Infrastructure\Common\ToolHandlerInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class InMemoryComposerFilesValidator
 * @package PhpGitHooks\Application\Composer
 */
class InMemoryComposerFilesValidator implements FilesValidatorInterface, ToolHandlerInterface
{
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
    public function validate()
    {
        // TODO: Implement validate() method.
    }

    /**
     * @param OutputInterface $outputInterface
     */
    public function setOutput(OutputInterface $outputInterface)
    {
        // TODO: Implement setOutput() method.
    }
}
