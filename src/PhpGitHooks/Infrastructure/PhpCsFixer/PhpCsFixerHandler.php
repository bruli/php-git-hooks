<?php

namespace PhpGitHooks\Infrastructure\PhpCsFixer;

use IgnoreFiles\IgnoreFiles;
use PhpGitHooks\Application\Message\MessageConfigData;
use PhpGitHooks\Command\BadJobLogo;
use PhpGitHooks\Command\OutputHandlerInterface;
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
     * @var IgnoreFiles
     */
    private $ignoreFiles;

    /**
     * PhpCsFixerHandler constructor.
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

                    if (false === $this->ignoreFiles->isIgnored($file)) {
                        $processBuilder = new ProcessBuilder(
                            array(
                                'php',
                                $this->getBinPath('php-cs-fixer'),
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
                }

                if (!empty($errors)) {
                    $this->outputHandler->setError($this->getErrors($errors));
                    $this->output->writeln($this->outputHandler->getError());
                    $this->output->writeln(BadJobLogo::paint($messages[MessageConfigData::KEY_ERROR_MESSAGE]));

                    throw  new PhpCsFixerException();
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

    /**
     * @param array $errors
     *
     * @return null|string
     */
    private function getErrors(array $errors)
    {
        $errorText = null;

        foreach ($errors as $error) {
            $errorText .= trim($error)."\n";
        }

        return $errorText;
    }
}
