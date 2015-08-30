<?php

namespace PhpGitHooks\Application\Composer;

use PhpGitHooks\Infrastructure\Common\FilesValidatorInterface;
use PhpGitHooks\Infrastructure\Common\ToolHandlerInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class InMemoryComposerFilesValidator.
 */
class InMemoryComposerFilesValidator implements FilesValidatorInterface, ToolHandlerInterface
{
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
    }

    /**
     * @param OutputInterface $outputInterface
     */
    public function setOutput(OutputInterface $outputInterface)
    {
    }
}
