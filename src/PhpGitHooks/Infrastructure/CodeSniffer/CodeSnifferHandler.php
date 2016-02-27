<?php

namespace PhpGitHooks\Infrastructure\CodeSniffer;

use IgnoreFiles\IgnoreFiles;
use PhpGitHooks\Application\Message\MessageConfigData;
use PhpGitHooks\Command\BadJobLogo;
use PhpGitHooks\Command\OutputHandlerInterface;
use PhpGitHooks\Infrastructure\Common\ToolHandler;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\ProcessBuilder;

/**
 * Class CodeSnifferHandler.
 */
class CodeSnifferHandler extends ToolHandler
{
    /** @var array */
    private $files;
    /** @var string */
    private $neddle;
    /** @var string */
    private $standard = 'PSR2';
    /**
     * @var IgnoreFiles
     */
    private $ignoreFiles;

    /**
     * CodeSnifferHandler constructor.
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
     * @throws InvalidCodingStandardException
     */
    public function run(array $messages)
    {
        $this->outputHandler->setTitle('Checking code style with PHPCS');
        $this->output->write($this->outputHandler->getTitle());

        foreach ($this->files as $file) {
            if (!preg_match($this->neddle, $file)) {
                continue;
            }

            if (false === $this->ignoreFiles->isIgnored($file)) {
                $processBuilder = new ProcessBuilder(array('php', 'bin/phpcs', '--standard='.$this->standard, $file));
                /** @var Process $phpCs */
                $phpCs = $processBuilder->getProcess();
                $phpCs->run();

                if (false === $phpCs->isSuccessful()) {
                    $this->outputHandler->setError($phpCs->getOutput());
                    $this->output->writeln($this->outputHandler->getError());
                    $this->output->writeln(BadJobLogo::paint($messages[MessageConfigData::KEY_ERROR_MESSAGE]));

                    throw new InvalidCodingStandardException();
                }
            }
        }

        $this->output->writeln($this->outputHandler->getSuccessfulStepMessage());
    }

    /**
     * @param string $neddle
     */
    public function setNeddle($neddle)
    {
        $this->neddle = $neddle;
    }

    /**
     * @param array $files
     */
    public function setFiles($files)
    {
        $this->files = $files;
    }

    /**
     * @param array $standard
     */
    public function setStandard($standard)
    {
        $this->standard = $standard;
    }
}
