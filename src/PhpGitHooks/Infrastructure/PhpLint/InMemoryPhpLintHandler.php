<?php

namespace PhpGitHooks\Infrastructure\PhpLint;

use Symfony\Component\Console\Output\OutputInterface;
use PhpGitHooks\Infrastructure\Common\FilesToolHandlerInterface;

/**
 * Class InMemoryPhpLintHandler
 * @package PhpGitHooks\Infrastructure\PhpLint
 */
class InMemoryPhpLintHandler implements FilesToolHandlerInterface
{
    /**
     * @param OutputInterface $outputInterface
     */
    public function setOutput(OutputInterface $outputInterface)
    {
        // TODO: Implement setOutput() method.
    }

    public function run()
    {
        // TODO: Implement run() method.
    }

    /**
     * @param array $files
     */
    public function setFiles(array $files)
    {
        // TODO: Implement setFiles() method.
    }
}
