<?php

namespace PhpGitHooks\Application\PhpCsFixer;

use PhpGitHooks\Application\Config\HookConfigInterface;
use PhpGitHooks\Infrastructure\Common\InteractiveToolInterface;
use PhpGitHooks\Infrastructure\Common\PreCommitExecuter;
use PhpGitHooks\Infrastructure\PhpCsFixer\PhpCsFixerHandler;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class FixCodeStyleCsFixerPreCommitExecuter.
 */
class FixCodeStyleCsFixerPreCommitExecuter extends PreCommitExecuter
{
    /** @var  PhpCsFixerHandler */
    private $phpCsFixerHandler;

    /**
     * @param HookConfigInterface      $hookConfigInterface
     * @param InteractiveToolInterface $toolHandlerInterface
     */
    public function __construct(
        HookConfigInterface $hookConfigInterface,
        InteractiveToolInterface $toolHandlerInterface
    ) {
        $this->preCommitConfig = $hookConfigInterface;
        $this->phpCsFixerHandler = $toolHandlerInterface;
    }

    /**
     * @return string
     */
    protected function commandName()
    {
        return 'php-cs-fixer';
    }

    /**
     * @param OutputInterface $output
     * @param array           $files
     * @param string          $needle
     */
    public function run(OutputInterface $output, array $files, $needle)
    {
        if ($this->isEnabled()) {
            $this->phpCsFixerHandler->setOutput($output);
            $this->phpCsFixerHandler->setFiles($files);
            $this->phpCsFixerHandler->setFilesToAnalize($needle);
            $this->phpCsFixerHandler->run();
        }
    }
}
