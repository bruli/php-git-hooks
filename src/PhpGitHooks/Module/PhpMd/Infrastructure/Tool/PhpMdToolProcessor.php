<?php

namespace PhpGitHooks\Module\PhpMd\Infrastructure\Tool;

use PhpGitHooks\Infrastructure\Tool\ToolPathFinder;
use PhpGitHooks\Module\PhpMd\Model\PhpMdToolProcessorInterface;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\ProcessBuilder;

class PhpMdToolProcessor implements PhpMdToolProcessorInterface
{
    /**
     * @var ToolPathFinder
     */
    private $toolPathFinder;

    /**
     * PhpMdToolProcessor constructor.
     *
     * @param ToolPathFinder $toolPathFinder
     */
    public function __construct(ToolPathFinder $toolPathFinder)
    {
        $this->toolPathFinder = $toolPathFinder;
    }

    /**
     * @param string $file
     * @param string $options
     *
     * @return string
     */
    public function process($file, $options)
    {
        $process = $this->execute($file, $options);

        return $this->setError($process);
    }

    /**
     * @param string $file
     * @param string $options
     *
     * @return Process
     */
    private function execute($file, $options)
    {
        $command = sprintf('php %s %s text ./PmdRules.xml %s', $this->toolPathFinder->find('phpmd'), $file, $options);

        $process = new Process($command);
        $process->run();

        return $process;
    }

    /**
     * @param Process $process
     *
     * @return null|string
     */
    private function setError(Process $process)
    {
        return false === $process->isSuccessful() ? $process->getOutput() : null;
    }
}
