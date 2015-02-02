<?php

namespace PhpGitHooks\Infrastructure\PhpCsFixer;

use PhpGitHooks\Infrastructure\Common\InteractiveToolInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class InMemoryPhpCsFixerHandler
 * @package PhpGitHooks\Infrastructure\PhpCsFixer
 */
class InMemoryPhpCsFixerHandler implements InteractiveToolInterface
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
     * @param string $filesToAnalize
     */
    public function setFilesToAnalize($filesToAnalize)
    {
        // TODO: Implement setFilesToAnalize() method.
    }

    /**
     * @param array $files
     */
    public function setFiles(array $files)
    {
        // TODO: Implement setFiles() method.
    }
}
