<?php

namespace PhpGitHooks\Infrastructure\PhpLint;

use PhpGitHooks\Infrastructure\Common\FilesToolHandlerInterface;
use PhpGitHooks\Infrastructure\Common\ToolHandler;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\ProcessBuilder;

/**
 * Class PhpLintHandler
 * @package PhpGitHooks\Infrastructure\PhpLint
 */
class PhpLintHandler extends ToolHandler implements FilesToolHandlerInterface
{
    const NEEDLE = '/(\.php)|(\.inc)$/';
    /** @var array */
    private $files;

    /**
     * @throws PhpLintException
     */
    public function run()
    {
        $this->outputHandler->setTitle('Running PHPLint');
        $this->output->write($this->outputHandler->getTitle());

        foreach ($this->files as $file) {
            if (!preg_match(self::NEEDLE, $file)) {
                continue;
            }

            $processBuilder = new ProcessBuilder(array('php', '-l', $file));
            /** @var Process $process */
            $process = $processBuilder->getProcess();
            $process->run();
        }

        /* @var Process $process */
        if (false === $process->isSuccessful()) {
            $this->outputHandler->setError($process->getErrorOutput());
            $this->output->writeln($this->outputHandler->getError());

            throw new PhpLintException();
        }

        $this->output->writeln($this->outputHandler->getSuccessfulStepMessage());
    }

    /**
     * @param array $files
     */
    public function setFiles(array $files)
    {
        $this->files = $files;
    }
}
