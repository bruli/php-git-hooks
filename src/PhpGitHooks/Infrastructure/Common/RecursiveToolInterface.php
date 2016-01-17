<?php

namespace PhpGitHooks\Infrastructure\Common;

use Symfony\Component\Console\Output\OutputInterface;

interface RecursiveToolInterface
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
     * @param string $needle
     */
    public function setNeedle($needle);

    /**
     * @param array $files
     */
    public function setFiles($files);
}
