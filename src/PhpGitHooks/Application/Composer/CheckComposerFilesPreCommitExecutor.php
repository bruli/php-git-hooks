<?php

namespace PhpGitHooks\Application\Composer;

use PhpGitHooks\Application\Config\HookConfigInterface;
use PhpGitHooks\Infrastructure\Common\FilesValidatorInterface;
use PhpGitHooks\Infrastructure\Common\PreCommitExecutor;
use Symfony\Component\Console\Output\OutputInterface;

class CheckComposerFilesPreCommitExecutor extends PreCommitExecutor
{
    /** @var ComposerFilesValidator  */
    private $composerFilesValidator;

    /**
     * @param FilesValidatorInterface $composerFilesValidator
     */
    public function __construct(
        HookConfigInterface $hookConfigInterface,
        FilesValidatorInterface $composerFilesValidator
    )
    {
        $this->preCommitConfig = $hookConfigInterface;
        $this->composerFilesValidator = $composerFilesValidator;
    }

    /**
     * @param OutputInterface $output
     * @param array           $files
     *
     * @throws ComposerJsonNotCommittedException
     */
    public function run(OutputInterface $output, array $files)
    {
        if ($this->isEnabled()) {
            $this->composerFilesValidator->setOutput($output);
            $this->composerFilesValidator->setFiles($files);
            $this->composerFilesValidator->validate();
        }
    }

    /**
     * @return string
     */
    protected function commandName()
    {
        return 'composer';
    }
}
