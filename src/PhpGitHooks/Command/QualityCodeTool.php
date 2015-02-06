<?php

namespace PhpGitHooks\Command;

use PhpGitHooks\Container;
use PhpGitHooks\Infrastructure\Git\ExtractCommitedFiles;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class QualityCodeTool
 * @package PhpGitHooks\Command
 */
class QualityCodeTool extends Application
{
    /** @var  OutputInterface */
    private $output;
    /** @var  array */
    private $files;
    /** @var  Container */
    private $container;
    /** @var  OutputHandler */
    private $outputTitleHandler;

    const PHP_FILES_IN_SRC = '/^src\/(.*)(\.php)$/';
    const COMPOSER_FILES    = '/^composer\.(json|lock)$/';

    public function __construct()
    {
        $this->container = new Container();
        $this->outputTitleHandler = new OutputHandler();

        parent::__construct('Code Quality Tool');
    }

    /**
     * @param InputInterface  $input
     * @param OutputInterface $output
     */
    public function doRun(InputInterface $input, OutputInterface $output)
    {
        $this->output = $output;

        $this->output->writeln('<fg=white;options=bold;bg=red>Pre-commit tool</fg=white;options=bold;bg=red>');
        $this->extractCommitedFiles();

        $this->execute();

        $this->output->writeln('<fg=white;options=bold;bg=blue>Hey!, good job!</fg=white;options=bold;bg=blue>');
    }

    private function extractCommitedFiles()
    {
        $this->outputTitleHandler->setTitle('Fetching files');
        $this->output->write($this->outputTitleHandler->getTitle());

        $commitFiles = new ExtractCommitedFiles();

        $this->files = $commitFiles->getFiles();

        if (count($this->files) > 1) {
            $result = 'Ok';
        } else {
            $result = 'No files changed';
        }

        $this->output->writeln($this->outputTitleHandler->getSuccessfulStepMessage($result));
    }

    /**
     * @return bool
     */
    private function isProcessingAnyPhpFile()
    {
        foreach ($this->files as $file) {
            $isPhpFile = preg_match(self::PHP_FILES_IN_SRC, $file);
            if ($isPhpFile) {
                return true;
            }
            $isComposerFile = preg_match(self::COMPOSER_FILES, $file);
            if ($isComposerFile) {
                return true;
            }
        }

        return false;
    }

    private function execute()
    {
        if ($this->isProcessingAnyPhpFile()) {
            $this->container->get('check.composer.files.pre.commit.executer')
                ->run($this->output, $this->files);

            $this->container->get('check.php.syntax.lint.pre.commit.executer')
                ->run($this->output, $this->files);

            $this->container->get('fix.code.style.cs.fixer.pre.commit.executer')
                ->run($this->output, $this->files, self::PHP_FILES_IN_SRC);

            $this->container->get('check.code.style.code.sniffer.pre.commit.executer')
                ->run($this->output, $this->files, self::PHP_FILES_IN_SRC);

            $this->container->get('check.php.mess.detection.pre.commit.executer')
                ->run($this->output, $this->files, self::PHP_FILES_IN_SRC);

            $this->container->get('unit.test.pre.commit.executer')->run($this->output);
        }
    }
}
