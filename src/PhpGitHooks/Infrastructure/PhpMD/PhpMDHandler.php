<?php

namespace PhpGitHooks\Infrastructure\PhpMD;

use IgnoreFiles\IgnoreFiles;
use PhpGitHooks\Application\Message\MessageConfigData;
use PhpGitHooks\Command\OutputHandlerInterface;
use PhpGitHooks\Infrastructure\Common\RecursiveToolInterface;
use PhpGitHooks\Infrastructure\Common\ToolHandler;
use Symfony\Component\Process\ProcessBuilder;

/**
 * Class PhpMDHandler.
 */
class PhpMDHandler extends ToolHandler implements RecursiveToolInterface
{
    /** @var  array */
    private $files;
    /** @var  string */
    private $needle;
    /**
     * @var IgnoreFiles
     */
    private $ignoreFiles;

    /**
     * PhpMDHandler constructor.
     *
     * @param OutputHandlerInterface $outputHandler
     * @param IgnoreFiles            $ignoreFiles
     */
    public function __construct(OutputHandlerInterface $outputHandler, IgnoreFiles $ignoreFiles)
    {
        parent::__construct($outputHandler);
        $this->ignoreFiles = $ignoreFiles;
    }

    /**
     * @param array $messages
     *
     * @throws PHPMDViolationsException
     */
    public function run(array $messages)
    {
        $this->outputHandler->setTitle('Checking code mess with PHPMD');
        $this->output->write($this->outputHandler->getTitle());

        $errors = [];

        foreach ($this->files as $file) {
            if (!preg_match($this->needle, $file)) {
                continue;
            }

            if (false === $this->ignoreFiles->isIgnored($file)) {
                $processBuilder = new ProcessBuilder(
                    array(
                        'php',
                        $this->getBinPath('phpmd'),
                        $file,
                        'text',
                        'PmdRules.xml',
                        '--minimumpriority',
                        1,
                    )
                );
                $process = $processBuilder->getProcess();
                $process->run();

                if (false === $process->isSuccessful()) {
                    $errors[] = $process->getOutput();
                }
            }
        }

        $errors = array_filter($errors, function ($var) {
            return trim($var);
        });

        if (!empty($errors)) {
            $this->writeOutputError(
                new PHPMDViolationsException(MessageConfigData::KEY_ERROR_MESSAGE),
                implode("\n", $errors)
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
