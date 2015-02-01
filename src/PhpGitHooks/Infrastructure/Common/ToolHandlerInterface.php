<?php

namespace PhpGitHooks\Infrastructure\Common;

use Symfony\Component\Console\Output\OutputInterface;

/**
 * Interface ToolHandlerInterface
 * @package PhpGitHooks\Infrastructure\Common
 */
interface ToolHandlerInterface
{
    /**
     * @param OutputInterface $outputInterface
     */
    public function setOutput(OutputInterface $outputInterface);
}
