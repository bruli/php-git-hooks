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
     * @return ProcessBuilder
     */
    public function getProcessBuilder()
    {
        return new ProcessBuilder(array('php', PHPGITHOOKS_BIN_DIR . '/phpunit'));
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
