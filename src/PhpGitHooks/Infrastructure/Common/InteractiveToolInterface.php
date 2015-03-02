<?php

namespace PhpGitHooks\Infrastructure\Common;

use Symfony\Component\Console\Output\OutputInterface;

/**
 * Interface InteractiveToolInterface.
 */
interface InteractiveToolInterface
{
    /**
     * @param OutputInterface $outputInterface
     */
    public function setOutput(OutputInterface $outputInterface);

    public function run();

    /**
     * @param string $filesToAnalize
     */
    public function setFilesToAnalize($filesToAnalize);

    /**
     * @param array $files
     */
    public function setFiles(array $files);
}
