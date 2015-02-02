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
        // TODO: Implement setOutput() method.
    }

    public function run()
    {
        // TODO: Implement run() method.
    }

    /**
     * @param string $needle
     */
    public function setNeedle($needle)
    {
        // TODO: Implement setNeedle() method.
    }

    /**
     * @param array $files
     */
    public function setFiles($files)
    {
        // TODO: Implement setFiles() method.
    }
}
