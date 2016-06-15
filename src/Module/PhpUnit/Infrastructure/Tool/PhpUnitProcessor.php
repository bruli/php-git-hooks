<?php

namespace Module\PhpUnit\Infrastructure\Tool;

use Infrastructure\Tool\ToolPathFinder;
use Module\PhpUnit\Model\PhpUnitProcessorInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Process\ProcessBuilder;

class PhpUnitProcessor implements PhpUnitProcessorInterface
{
    /**
     * @var OutputInterface
     */
    private $output;
    /**
     * @var ToolPathFinder
     */
    private $toolPathFinder;

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
     * @param $options
     *
     * @return bool
     */
    public function process($options)
    {
        $processBuilder = new ProcessBuilder(
            [
                'php',
                $this->toolPathFinder->find('phpunit'),
                $options,
            ]
        );

        $process = $processBuilder->getProcess();
        $output = $this->output;

        $process->run(function ($type, $buffer) use ($output) {
            $type;
            $output->write($buffer);
        });

        return $process->isSuccessful();
    }
}
