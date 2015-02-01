<?php

namespace PhpGitHooks\Application\Composer;

use PhpGitHooks\Infrastructure\Common\FilesValidatorInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class CheckComposerFilesPreCommitExecuter
 * @package PhpGitHooks\Application\Composer
 */
class CheckComposerFilesPreCommitExecuter
{
    /** @var ComposerFilesValidator  */
    private $composerFilesValidator;

    /**
     * @param FilesValidatorInterface $composerFilesValidator
     */
    public function __construct(FilesValidatorInterface $composerFilesValidator)
    {
        $this->composerFilesValidator = $composerFilesValidator;
    }

    /**
     * @param  OutputInterface                  $output
     * @param  array                            $files
     * @throws ComposerJsonNotCommitedException
     */
    public function run(OutputInterface $output, array $files)
    {
        $this->composerFilesValidator->setOutput($output);
        $this->composerFilesValidator->setFiles($files);
        $this->composerFilesValidator->validate();
    }
}
