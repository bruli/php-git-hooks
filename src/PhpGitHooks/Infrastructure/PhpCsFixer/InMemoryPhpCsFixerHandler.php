<?php

namespace PhpGitHooks\Infrastructure\PhpCsFixer;

use PhpGitHooks\Infrastructure\Common\InteractiveToolInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class InMemoryPhpCsFixerHandler.
 */
class InMemoryPhpCsFixerHandler implements InteractiveToolInterface, PhpCsFixerHandlerInterface
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
     * @param string $filesToAnalyze
     */
    public function setFilesToAnalyze($filesToAnalyze)
    {
    }

    /**
     * @param array $levels
     */
    public function setLevels(array $levels)
    {
    }

    /**
     * @param array $messages
     *
     * @return mixed
     */
    public function run(array $messages)
    {
    }
}
