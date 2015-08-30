<?php

namespace PhpGitHooks\Infrastructure\PhpCsFixer;

use PhpGitHooks\Infrastructure\Common\InteractiveToolInterface;
use PhpGitHooks\Infrastructure\Common\ToolHandler;
use Symfony\Component\Process\ProcessBuilder;

class PhpCsFixerHandler extends ToolHandler implements InteractiveToolInterface
{
    /** @var array */
    private $files;
    /** @var string */
    private $filesToAnalyze;
    /** @var  string */
    private $level;

    public function run()
    {
        $this->outputHandler->setTitle('Checking '.strtoupper($this->level).' code style with PHP-CS-FIXER');
        $this->output->write($this->outputHandler->getTitle());

        $errors = array();

        foreach ($this->files as $file) {
            $srcFile = preg_match($this->filesToAnalyze, $file);

            if (!$srcFile) {
                continue;
            }

            $processBuilder = new ProcessBuilder(
                array(
                    'php',
                    'bin/php-cs-fixer',
                    '--dry-run',
                    'fix',
                    $file,
                    '--fixers='.$this->level,
                )
            );

            $phpCsFixer = $processBuilder->getProcess();
            $phpCsFixer->run();

            if (false === $phpCsFixer->isSuccessful()) {
                $errors[] = $phpCsFixer->getOutput();
            }
        }

        if ($errors) {
            throw new PhpCsFixerException(implode('', $errors));
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

    /**
     * @param string $filesToAnalyze
     */
    public function setFilesToAnalyze($filesToAnalyze)
    {
        $this->filesToAnalyze = $filesToAnalyze;
    }

    /**
     * @param string $level
     */
    public function setLevel($level)
    {
        $this->level = $level;
    }
}
