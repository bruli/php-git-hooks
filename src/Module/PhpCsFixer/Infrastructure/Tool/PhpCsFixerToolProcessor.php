<?php

namespace Module\PhpCsFixer\Infrastructure\Tool;

use Infrastructure\Tool\ToolPathFinder;
use Module\PhpCsFixer\Model\PhpCsFixerToolProcessorInterface;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\ProcessBuilder;

class PhpCsFixerToolProcessor implements PhpCsFixerToolProcessorInterface
{
    /**
     * @var ToolPathFinder
     */
    private $toolPathFinder;

    /**
     * PhpCsFixerToolProcessor constructor.
     *
     * @param ToolPathFinder $toolPathFinder
     */
    public function __construct(ToolPathFinder $toolPathFinder)
    {
        $this->toolPathFinder = $toolPathFinder;
    }

    /**
     * @param string $file
     * @param string $level
     *
     * @return string
     */
    public function process($file, $level)
    {
        $process = $this->processTool($file, $level);

        return $this->setError($process);
    }

    /**
     * @param string $file
     * @param string $level
     *
     * @return Process
     */
    private function processTool($file, $level)
    {
        $processBuilder = new ProcessBuilder(
            [
                'php',
                $this->toolPathFinder->find('php-cs-fixer'),
                '--dry-run',
                'fix',
                $file,
                '--level='.$level,
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
    private function setError(Process $process)
    {
        if (false === $process->isSuccessful()) {
            return $process->getOutput();
        }
    }
}
