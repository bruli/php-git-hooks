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

    /**
     * @param array $messages
     *
     * @return mixed
     */
    public function run(array $messages);

    /**
     * @param string $filesToAnalyze
     */
    public function setFilesToAnalyze($filesToAnalyze);

    /**
     * @param array $files
     */
    public function setFiles(array $files);
}
