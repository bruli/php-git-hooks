<?php

namespace PhpGitHooks\Infrastructure\PhpLint;

use Symfony\Component\Console\Output\OutputInterface;
use PhpGitHooks\Infrastructure\Common\FilesToolHandlerInterface;

/**
 * Class InMemoryPhpLintHandler.
 */
class InMemoryPhpLintHandler implements FilesToolHandlerInterface
{
    /**
     * @param OutputInterface $outputInterface
     */
    public function setOutput(OutputInterface $outputInterface)
    {
    }

    /**
     * @param array $files
     */
    public function setFiles(array $files)
    {
    }

    /**
     * @param array $messages
     */
    public function run(array $messages)
    {
    }
}
