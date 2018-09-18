<?php

namespace PhpGitHooks\Module\PhpLint\Infrastructure\Tool;

use PhpGitHooks\Module\PhpLint\Model\PhpLintToolProcessorInterface;
use Symfony\Component\Process\Process;

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
        $process = new Process(
            [
                'php',
                '-l',
                $file,
            ]
        );

        $process->run();

        return $process;
    }

    /**
     * @param Process $process
     *
     * @return null|string
     */
    private function setErrors(Process $process)
    {
        return false === $process->isSuccessful() ? $process->getErrorOutput() : null;
    }
}
