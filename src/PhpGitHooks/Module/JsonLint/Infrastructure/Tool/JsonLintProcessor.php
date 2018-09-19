<?php

namespace PhpGitHooks\Module\JsonLint\Infrastructure\Tool;

use PhpGitHooks\Infrastructure\Tool\ToolPathFinder;
use PhpGitHooks\Module\JsonLint\Model\JsonLintProcessorInterface;
use Symfony\Component\Process\Process;

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
        $process = new Process(
            [
                'php',
                $this->toolPathFinder->find('jsonlint'),
                $file,
            ]
        );

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
            return $process->getErrorOutput();
        }
    }
}
