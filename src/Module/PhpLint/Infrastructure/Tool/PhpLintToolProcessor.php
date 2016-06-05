<?php

namespace Module\PhpLint\Infrastructure\Tool;

use Module\PhpLint\Model\PhpLintToolProcessorInterface;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\ProcessBuilder;

class PhpLintToolProcessor implements PhpLintToolProcessorInterface
{
    /**
     * @param string $file
     *
     * @return string
     */
    public function process($file)
    {
        $process = $this->execute($file);

        return $this->setErrors($process);
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
                '-l',
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
