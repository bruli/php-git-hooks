<?php

namespace PhpGitHooks\Module\PhpCs\Infrastructure\Tool;

use PhpGitHooks\Infrastructure\Tool\ToolPathFinder;
use PhpGitHooks\Module\PhpCs\Model\PhpCsToolProcessorInterface;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\ProcessBuilder;

class PhpCsToolProcessor implements PhpCsToolProcessorInterface
{
    /**
     * @var ToolPathFinder
     */
    private $toolPathFinder;

    /**
     * PhpCsToolProcessor constructor.
     *
     * @param ToolPathFinder $toolPathFinder
     */
    public function __construct(ToolPathFinder $toolPathFinder)
    {
        $this->toolPathFinder = $toolPathFinder;
    }

    /**
     * @param string $file
     * @param string $standard
     *
     * @return string
     */
    public function process($file, $standard)
    {
        $process = $this->execute($file, $standard);

        return $this->setErrors($process);
    }

    /**
     * @param string $file
     * @param string $standard
     *
     * @return Process
     */
    private function execute($file, $standard)
    {
        $processBuilder = new ProcessBuilder(
            [
                'php',
                $this->toolPathFinder->find('phpcs'),
                '--standard='.$standard,
                $file,
            ]
        );

        $process = $processBuilder->getProcess();
        $process->run();

        return $process;
    }

    /**
     * @param Process $process
     *
     * @return string
     */
    private function setErrors(Process $process)
    {
        if (false === $process->isSuccessful()) {
            return $process->getOutput();
        }
    }
}
