<?php

namespace PhpGitHooks\Infrastructure\Common;

use Symfony\Component\Console\Output\OutputInterface;

interface FilesToolHandlerInterface
{
    /**
     * @param OutputInterface $outputInterface
     */
    public function setOutput(OutputInterface $outputInterface);

    /**
     * @param array $messages
     */
    public function run(array $messages);

    /**
     * @param array $files
     */
    public function setFiles(array $files);
}
