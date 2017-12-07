<?php

namespace PhpGitHooks\Module\PhpCs\Infrastructure\Tool;

use PhpGitHooks\Infrastructure\Tool\ToolPathFinder;
use PhpGitHooks\Module\PhpCs\Model\PhpCsToolProcessorInterface;
use Symfony\Component\Process\Process;

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
     * @param string $ignore
     *
     * @return string
     */
    public function process($file, $standard, $ignore)
    {
        $process = $this->execute($file, $standard, $ignore);

        return $this->setErrors($process);
    }

    /**
     * @param string $file
     * @param string $standard
     * @param string $ignore
     *
     * @return Process
     */
    private function execute($file, $standard, $ignore)
    {
        $process = new Process(
            [
                'php',
                $this->toolPathFinder->find('phpcs'),
                '--standard='.$standard,
                '--ignore='.$ignore,
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
            return $process->getOutput();
        }
    }
}
