<?php

namespace PhpGitHooks\Infrastructure\PhpMD;

use PhpGitHooks\Infrastructure\Common\RecursiveToolInterface;
use Symfony\Component\Console\Output\OutputInterface;

class InMemoryPhpMDHandler implements RecursiveToolInterface
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
     * @param string $needle
     */
    public function setNeedle($needle)
    {
    }

    /**
     * @param array $files
     */
    public function setFiles($files)
    {
    }
}
