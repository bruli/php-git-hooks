<?php

namespace PhpGitHooks\Infrastructure\JsonLint;

use PhpGitHooks\Application\Message\MessageConfigData;
use PhpGitHooks\Infrastructure\Common\RecursiveToolInterface;
use PhpGitHooks\Infrastructure\Common\ToolHandler;
use Symfony\Component\Process\ProcessBuilder;

final class JsonLintHandler extends ToolHandler implements RecursiveToolInterface
{
    /** @var array */
    private $files = [];
    /** @var  string */
    private $needle;

    /**
     * @param array $messages
     *
     * @throws JsonLintViolationsException
     */
    public function run(array $messages)
    {
        $this->outputHandler->setTitle(sprintf('Checking json code with %s', strtoupper('jsonlint')));
        $this->output->write($this->outputHandler->getTitle());

        $errors = [];

        foreach ($this->files as $file) {
            if (!preg_match($this->needle, $file)) {
                continue;
            }

            $processBuilder = new ProcessBuilder(
                array(
                    'php',
                    $this->getBinPath('jsonlint'),
                    $file,
                )
            );
            $process = $processBuilder->getProcess();
            $process->run();

            if (false === $process->isSuccessful()) {
                $errors[] = $process->getOutput();
            }
        }

        $errors = array_filter($errors, function ($var) {
            return !is_null($var);
        });

        if ($errors) {
            $this->writeOutputError(
                new JsonLintViolationsException(implode('', $errors)),
                $messages[MessageConfigData::KEY_ERROR_MESSAGE]
            );
        }

        $this->output->writeln($this->outputHandler->getSuccessfulStepMessage());
    }

    /**
     * @param string $needle
     */
    public function setNeedle($needle)
    {
        $this->needle = $needle;
    }

    /**
     * @param array $files
     */
    public function setFiles($files)
    {
        $this->files = $files;
    }
}
