<?php

namespace PhpGitHooks\Application\PhpLint;

use PhpGitHooks\Application\Config\HookConfigInterface;
use PhpGitHooks\Infrastructure\Common\FilesToolHandlerInterface;
use PhpGitHooks\Infrastructure\Common\PreCommitExecuter;
use PhpGitHooks\Infrastructure\PhpLint\PhpLintHandler;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class CheckPhpSyntaxLintPreCommitExecuter.
 */
class CheckPhpSyntaxLintPreCommitExecuter extends PreCommitExecuter
{
    /** @var  PhpLintHandler */
    private $phpLintHandler;

    /**
     * @param HookConfigInterface       $hookConfigInterface
     * @param FilesToolHandlerInterface $filesToolhandlerInterface
     */
    public function __construct(
        HookConfigInterface $hookConfigInterface,
        FilesToolHandlerInterface $filesToolhandlerInterface
    ) {
        $this->preCommitConfig = $hookConfigInterface;
        $this->phpLintHandler = $filesToolhandlerInterface;
    }

    /**
     * @param OutputInterface $output
     * @param array           $files
     *
     * @throws string PhpLintException
     */
    public function run(OutputInterface $output, array $files)
    {
        if ($this->isEnabled()) {
            $this->phpLintHandler->setOutput($output);
            $this->phpLintHandler->setFiles($files);
            $this->phpLintHandler->run();
        }
    }

    /**
     * @return string
     */
    protected function commandName()
    {
        return 'phplint';
    }
}
