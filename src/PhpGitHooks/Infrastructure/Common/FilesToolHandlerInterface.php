<?php

namespace PhpGitHooks\Infrastructure\Common;

use Symfony\Component\Console\Output\OutputInterface;

interface FilesToolHandlerInterface
{
    /**
     * @param OutputInterface $outputInterface
     */
    public function setOutput(OutputInterface $outputInterface);

    public function run();

    /**
     * @param array $files
     */
    public function setFiles(array $files);
}
