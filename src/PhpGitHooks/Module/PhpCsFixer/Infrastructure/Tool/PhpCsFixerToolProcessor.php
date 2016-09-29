<?php

namespace PhpGitHooks\Module\PhpCsFixer\Infrastructure\Tool;

use PhpGitHooks\Infrastructure\Tool\ToolPathFinder;
use PhpGitHooks\Module\PhpCsFixer\Model\PhpCsFixerToolProcessorInterface;
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
     * @param string $options
     *
     * @return string
     */
    public function process($file, $level, $options)
    {
        $process = $this->processTool($file, $level, $options);

        return $this->setError($process);
    }

    /**
     * @param string $file
     * @param string $level
     * @param string $options
     *
     * @return Process
     */
    private function processTool($file, $level, $options)
    {
        $arguments = [
            'php',
            $this->toolPathFinder->find('php-cs-fixer'),
            '--dry-run',
            'fix',
            $file,
            '--level='.$level,
        ];

        if (null !== $options) {
            $arguments = array_merge($arguments, explode(' ', trim($options)));
        }

        $processBuilder = new ProcessBuilder($arguments);

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
