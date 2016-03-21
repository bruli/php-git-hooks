<?php

namespace PhpGitHooks\Infrastructure\PhpUnit;

use PhpGitHooks\Infrastructure\Common\ProcessBuilderInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\ProcessBuilder;

/**
 * Class PhpUnitProcessBuilder.
 */
class PhpUnitProcessBuilder implements ProcessBuilderInterface
{
    /**
     * @var bool|string
     */
    protected $suite = false;

    /**
     * @return ProcessBuilder
     */
    public function getProcessBuilder()
    {
        $params = array('php', 'bin/phpunit');
        if ($this->suite) {
            $params[] = '--testsuite';
            $params[] = $this->suite;
        }

        return new ProcessBuilder($params);
    }

    /**
     * @param $suite
     */
    public function setSuite($suite)
    {
        $this->suite = $suite;
    }

    /**
     * @param Process         $process
     * @param OutputInterface $outputInterface
     *
     * @return int
     */
    public function executeProcess(Process $process, OutputInterface $outputInterface)
    {
        return $process->run(function ($type, $buffer) use ($outputInterface) {
            $type;
            $outputInterface->write($buffer);
        });
    }
}
