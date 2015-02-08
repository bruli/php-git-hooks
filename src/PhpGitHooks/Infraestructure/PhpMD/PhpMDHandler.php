<?php

namespace PhpGitHooks\Infraestructure\PhpMD;

use PhpGitHooks\Infraestructure\Common\ToolHandler;
use Symfony\Component\Process\ProcessBuilder;

/**
 * Class PhpMDHandler
 * @package PhpGitHooks\Infraestructure\PhpMD
 */
class PhpMDHandler extends ToolHandler
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
                [
                    'php',
                    'bin/phpmd',
                    $file,
                    'text',
                    'PmdRules.xml',
                    '--minimumpriority',
                    1
                ]
            );
            $process = $processBuilder->getProcess();
            $process->run();

            if (false === $process->isSuccessful()) {
                $errors[] = $process->getOutput();
            }
        }

        if ($errors) {
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
