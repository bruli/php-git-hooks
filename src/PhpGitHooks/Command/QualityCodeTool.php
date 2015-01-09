<?php

namespace PhpGitHooks\Command;

use PhpGitHooks\Container;
use PhpGitHooks\Infraestructure\CodeSniffer\CodeSnifferHandler;
use PhpGitHooks\Infraestructure\Composer\ComposerFilesValidator;
use PhpGitHooks\Infraestructure\Config\PreCommitConfig;
use PhpGitHooks\Infraestructure\Git\ExtractCommitedFiles;
use PhpGitHooks\Infraestructure\CodeSniffer\InvalidCodingStandardException;
use PhpGitHooks\Infraestructure\PhpCsFixer\PhpCsFixerHandler;
use PhpGitHooks\Infraestructure\PhpLint\PhpLintException;
use PhpGitHooks\Infraestructure\PhpLint\PhpLintHandler;
use PhpGitHooks\Infraestructure\PhpMD\PhpMDHandler;
use PhpGitHooks\Infraestructure\PhpMD\PHPMDViolationsException;
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
    /** @var  PreCommitConfig */
    private $preCommitConfig;
    const PHP_FILES_IN_SRC = '/^src\/(.*)(\.php)$/';

    public function __construct()
    {
        $this->container = new Container();
        $this->outputTitleHandler = new OutputHandler();
        $this->preCommitConfig = $this->container->get('pre.commit.config');

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

        if ($this->isProcessingAnyPhpFile()) {
            $this->checkComposerJsonAndLockSync();
            $this->checkPhpSyntaxWithLint();
            $this->checkCodeStyleWithCsFixer();
            
            $this->container->get('check.code.style.code.sniffer.pre.commit.executer')
                ->run($this->output, $this->files, self::PHP_FILES_IN_SRC);

            $this->container->get('check.php.mess.detection.pre.commit.executer')
                ->run($this->output, $this->files, self::PHP_FILES_IN_SRC);

            $this->container->get('unit.test.pre.commit.executer')->run($this->output);

            $this->output->writeln('<fg=white;options=bold;bg=blue>Hey!, good job!</fg=white;options=bold;bg=blue>');
        }
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
        }

        return false;
    }

    /**
     * @throws \PhpGitHooks\Infraestructure\Composer\ComposerJsonNotCommitedException
     */
    private function checkComposerJsonAndLockSync()
    {
        /** @var ComposerFilesValidator $composerValidator */
        $composerValidator = $this->container->get('composer.files.validator');
        $composerValidator->setOutput($this->output);
        $composerValidator->setFiles($this->files);
        $composerValidator->validate();
    }

    /**
     * @throws PhpLintException
     */
    private function checkPhpSyntaxWithLint()
    {
        if ($this->isEnabledInConfig('phplint') === true) {
            /** @var PhpLintHandler $phplint */
            $phplint = $this->container->get('php.lint.handler');
            $phplint->setOutput($this->output);
            $phplint->setFiles($this->files);
            $phplint->run();
        }
    }

    private function checkCodeStyleWithCsFixer()
    {
        if ($this->isEnabledInConfig('php-cs-fixer') === true) {
            /** @var PhpCsFixerHandler $phpCsFixer */
            $phpCsFixer = $this->container->get('php.cs.fixer.handler');
            $phpCsFixer->setOutput($this->output);
            $phpCsFixer->setFiles($this->files);
            $phpCsFixer->setFilesToAnalize(self::PHP_FILES_IN_SRC);
            $phpCsFixer->run();
        }
    }

    /**
     * @param  string $stepName
     * @return bool
     */
    private function isEnabledInConfig($stepName)
    {
        return $this->preCommitConfig->isEnabled($stepName);
    }
}
