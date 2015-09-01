<?php

namespace PhpGitHooks\Infrastructure\CodeSniffer;

use PhpGitHooks\Command\BadJobLogo;
use PhpGitHooks\Infrastructure\Common\ToolHandler;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\ProcessBuilder;

/**
 * Class CodeSnifferHandler.
 */
class CodeSnifferHandler extends ToolHandler
{
    const STANDARD = 'PSR2';
    /** @var array */
    private $files;
    /** @var string */
    private $neddle;

    /**
     * @throws InvalidCodingStandardException
     */
    public function run()
    {
        $this->outputHandler->setTitle('Checking code style with PHPCS');
        $this->output->write($this->outputHandler->getTitle());

        foreach ($this->files as $file) {
            if (!preg_match($this->neddle, $file)) {
                continue;
            }

            $processBuilder = new ProcessBuilder(array('php', 'bin/phpcs', '--standard='.self::STANDARD.'', $file));
            /** @var Process $phpCs */
            $phpCs = $processBuilder->getProcess();
            $phpCs->run();

            if (false === $phpCs->isSuccessful()) {
                $this->outputHandler->setError($phpCs->getOutput());
                $this->output->writeln($this->outputHandler->getError());
                $this->output->writeln(BadJobLogo::paint());

                throw new InvalidCodingStandardException();
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
}
