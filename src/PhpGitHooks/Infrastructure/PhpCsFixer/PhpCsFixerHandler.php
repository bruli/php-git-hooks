<?php

namespace PhpGitHooks\Infrastructure\PhpCsFixer;

use PhpGitHooks\Infrastructure\Common\InteractiveToolInterface;
use PhpGitHooks\Infrastructure\Common\ToolHandler;
use Symfony\Component\Process\ProcessBuilder;

/**
 * Class PhpCsFixerHandler
 * @package PhpGitHooks\Infrastructure\PhpCsFixer
 */
class PhpCsFixerHandler extends ToolHandler implements InteractiveToolInterface
{
    const FIXERS = '-psr0';
    /** @var array */
    private $files;
    /** @var string */
    private $filesToAnalize;

    public function run()
    {
        $this->outputHandler->setTitle('Checking code style with PHP-CS-FIXER');
        $this->output->write($this->outputHandler->getTitle());

        $errors = array();

        foreach ($this->files as $file) {
            $srcFile = preg_match($this->filesToAnalize, $file);

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
                    '--fixers='.self::FIXERS,
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
     * @param string $filesToAnalize
     */
    public function setFilesToAnalize($filesToAnalize)
    {
        $this->filesToAnalize = $filesToAnalize;
    }

    /**
     * @param array $files
     */
    public function setFiles(array $files)
    {
        $this->files = $files;
    }
}
