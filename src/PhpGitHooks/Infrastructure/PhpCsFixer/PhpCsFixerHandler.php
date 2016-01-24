<?php

namespace PhpGitHooks\Infrastructure\PhpCsFixer;

use PhpGitHooks\Application\Message\MessageConfigData;
use PhpGitHooks\Infrastructure\Common\InteractiveToolInterface;
use PhpGitHooks\Infrastructure\Common\ToolHandler;
use Symfony\Component\Process\ProcessBuilder;

class PhpCsFixerHandler extends ToolHandler implements InteractiveToolInterface, PhpCsFixerHandlerInterface
{
    /** @var array */
    private $files;
    /** @var string */
    private $filesToAnalyze;
    /** @var  array */
    private $levels = [];

    /**
     * @throws PhpCsFixerException
     */
    public function run(array $messages)
    {
        foreach ($this->levels as $level => $value) {
            if (true === $value) {
                $this->outputHandler->setTitle('Checking '.strtoupper($level).' code style with PHP-CS-FIXER');
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
                            '--level='.$level,
                        )
                    );

                    $phpCsFixer = $processBuilder->getProcess();
                    $phpCsFixer->run();

                    if (false === $phpCsFixer->isSuccessful()) {
                        $errors[] = $phpCsFixer->getOutput();
                    }
                }

                if ($errors) {
                    $this->writeOutputError(
                        new PhpCsFixerException(implode('', $errors)),
                        $messages[MessageConfigData::KEY_ERROR_MESSAGE]
                    );
                }

                $this->output->writeln($this->outputHandler->getSuccessfulStepMessage());
            }
        }
    }

    /**
     * throw new PhpCsFixerException(implode('', $errors));
     * }.
     *
     * $this->output->writeln($this->outputHandler->getSuccessfulStepMessage());
     * }
     *
     * /**
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
     * @param array $levels
     */
    public function setLevels(array $levels)
    {
        $this->levels = $levels;
    }
}
