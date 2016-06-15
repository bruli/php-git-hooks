<?php

namespace Module\PhpUnit\Infrastructure\Tool;

use Infrastructure\Tool\ToolPathFinder;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Process\Process;

abstract class AbstractPhpUnitProcessor
{
    /**
     * @var OutputInterface
     */
    protected $output;
    /**
     * @var ToolPathFinder
     */
    protected $toolPathFinder;

    /**
     * PhpUnitProcessor constructor.
     *
     * @param OutputInterface $output
     * @param ToolPathFinder  $toolPathFinder
     */
    public function __construct(OutputInterface $output, ToolPathFinder $toolPathFinder)
    {
        $this->output = $output;
        $this->toolPathFinder = $toolPathFinder;
    }

    /**
     * @param Process $process
     *
     * @return mixed
     */
    protected function runProcess(Process $process)
    {
        $output = $this->output;

        $process->run(
            function ($type, $buffer) use ($output) {
                $type;
                $output->write($buffer);
            }
        );

        return $process->isSuccessful();
    }
}
