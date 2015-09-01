<?php

namespace PhpGitHooks\Infrastructure\PhpMD;

use PhpGitHooks\Command\BadJobLogo;
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
     * @throws PHPMDViolationsException
     */
    public function run()
    {
        $this->outputHandler->setTitle('Checking code mess with PHPMD');
        $this->output->write($this->outputHandler->getTitle());

        $errors = [];

        foreach ($this->files as $file) {
            if (!preg_match($this->needle, $file)) {
                continue;
            }

            $processBuilder = new ProcessBuilder(
                array(
                    'php',
                    'bin/phpmd',
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

        $errors = array_filter($errors, function ($var) {
            return !is_null($var);
        });

        if ($errors) {
            $this->output->writeln(BadJobLogo::paint());
            throw new PHPMDViolationsException(implode('', $errors));
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
