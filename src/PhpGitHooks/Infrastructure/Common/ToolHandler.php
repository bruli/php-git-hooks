<?php

namespace PhpGitHooks\Infrastructure\Common;

use PhpGitHooks\Command\OutputHandlerInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class ToolHandler
 * @package PhpGitHooks\Infrastructure\Common
 */
abstract class ToolHandler
{
    /** @var OutputHandlerInterface  */
    protected $outputHandler;
    /** @var  OutputInterface */
    protected $output;

    /**
     * @param OutputHandlerInterface $outputHandler
     */
    public function __construct(OutputHandlerInterface $outputHandler)
    {
        $this->outputHandler = $outputHandler;
    }

    /**
     * @param OutputInterface $outputInterface
     */
    public function setOutput(OutputInterface $outputInterface)
    {
        $this->output = $outputInterface;
    }
}
