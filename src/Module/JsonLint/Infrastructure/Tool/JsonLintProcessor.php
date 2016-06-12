<?php

namespace Module\JsonLint\Infrastructure\Tool;

use Infrastructure\Tool\ToolPathFinder;
use Module\JsonLint\Model\JsonLintProcessorInterface;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\ProcessBuilder;

class JsonLintProcessor implements JsonLintProcessorInterface
{
    /**
     * @var ToolPathFinder
     */
    private $toolPathFinder;

    /**
     * JsonLintProcessor constructor.
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
                $this->toolPathFinder->find('jsonlint'),
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
