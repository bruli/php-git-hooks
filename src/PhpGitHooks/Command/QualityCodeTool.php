<?php

namespace PhpGitHooks\Command;

use PhpGitHooks\Container;
use PhpGitHooks\Infrastructure\Git\ExtractCommitedFiles;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class QualityCodeTool.
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
    const JSON_FILES_IN_SRC = '/^src\/(.*)(\.json)$/';
    const YML_FILES_IN_SRC = '/^src\/(.*)(\.yml)$/';
    const COMPOSER_FILES = '/^composer\.(json|lock)$/';

    public function __construct()
    {
        $this->container = new Container();
        $this->outputTitleHandler = new OutputHandler();

        parent::__construct('Code Quality Tool');
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     */
    public function doRun(InputInterface $input, OutputInterface $output)
    {
        $this->output = $output;

        $this->output->writeln('<fg=white;options=bold;bg=red>Pre-commit tool</fg=white;options=bold;bg=red>');
        $this->extractCommitFiles();

        $this->execute();

        $this->output->writeln('<fg=white;options=bold;bg=blue>Hey!, good job!</fg=white;options=bold;bg=blue>');
    }

    private function extractCommitFiles()
    {
        $this->outputTitleHandler->setTitle('Fetching files');
        $this->output->write($this->outputTitleHandler->getTitle());

        $commitFiles = new ExtractCommitedFiles();

        $this->files = $commitFiles->getFiles();

        if (count($this->files) > 1) {
            $result = '0k';
        } else {
            $result = 'No files changed';
        }

        $this->output->writeln($this->outputTitleHandler->getSuccessfulStepMessage($result));
    }

    /**
     * @return array
     */
    private function processingFiles()
    {
        $files = [];

        foreach ($this->files as $file) {
            $files = [
                'php' => preg_match(self::PHP_FILES_IN_SRC, $file),
                'composer' => preg_match(self::COMPOSER_FILES, $file),
                'json' => preg_match(self::JSON_FILES_IN_SRC, $file),
                'yml' => preg_match(self::YML_FILES_IN_SRC, $file)
            ];

        }

        return $files;
    }

    private function execute()
    {
        if ($this->isProcessingAnyComposerFile()) {
            $this->container->get('check.composer.files.pre.commit.executor')
                ->run($this->output, $this->files);
        }

        if ($this->isProcessingAnyPhpFile()) {
            $this->container->get('check.php.syntax.lint.pre.commit.executor')
                ->run($this->output, $this->files);

            $this->container->get('fix.code.style.cs.fixer.pre.commit.executor')
                ->run($this->output, $this->files, self::PHP_FILES_IN_SRC);

            $this->container->get('check.code.style.code.sniffer.pre.commit.executor')
                ->run($this->output, $this->files, self::PHP_FILES_IN_SRC);

            $this->container->get('check.php.mess.detection.pre.commit.executor')
                ->run($this->output, $this->files, self::PHP_FILES_IN_SRC);

            $this->container->get('unit.test.pre.commit.executor')->run($this->output);
        }
    }

    /**
     * @return bool
     */
    private function isProcessingAnyComposerFile()
    {
        $files = $this->processingFiles();

        return $files['composer'];
    }

    /**
     * @return bool
     */
    private function isProcessingAnyPhpFile()
    {
        $files = $this->processingFiles();

        return $files['php'];
    }
}
