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
     *
     * @return string
     */
    public function process($file)
    {
        $process = $this->execute($file);

        return $this->setError($process);
    }

    /**
     * @param string $file
     *
     * @return Process
     */
    private function execute($file)
    {
        $processBuilder = new ProcessBuilder(
            [
                'php',
                $this->toolPathFinder->find('phpmd'),
                $file,
                'text',
                'PmdRules.xml',
                '--minimumpriority',
                1,
            ]
        );

        $process = $processBuilder->getProcess();
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
