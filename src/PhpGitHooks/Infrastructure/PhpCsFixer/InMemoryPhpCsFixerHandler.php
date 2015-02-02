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
    }

    public function run()
    {
    }

    /**
     * @param string $filesToAnalize
     */
    public function setFilesToAnalize($filesToAnalize)
    {
    }

    /**
     * @param array $files
     */
    public function setFiles(array $files)
    {
    }
}
