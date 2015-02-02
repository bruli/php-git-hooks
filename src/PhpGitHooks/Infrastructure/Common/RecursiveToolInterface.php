<?php

namespace PhpGitHooks\Infrastructure\Common;

use Symfony\Component\Console\Output\OutputInterface;

interface RecursiveToolInterface
{
    /**
     * @param OutputInterface $outputInterface
     */
    public function setOutput(OutputInterface $outputInterface);

    public function run();

    /**
     * @param string $needle
     */
    public function setNeedle($needle);

    /**
     * @param array $files
     */
    public function setFiles($files);
}
