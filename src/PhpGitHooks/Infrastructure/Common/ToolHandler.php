<?php

namespace PhpGitHooks\Infrastructure\Common;

use PhpGitHooks\Command\OutputHandler;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class ToolHandler
 * @package PhpGitHooks\Infrastructure\Common
 */
abstract class ToolHandler
{
    /** @var OutputHandler  */
    protected $outputHandler;
    /** @var  OutputInterface */
    protected $output;

    /**
     * @param OutputHandler $outputHandler
     */
    public function __construct(OutputHandler $outputHandler)
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
