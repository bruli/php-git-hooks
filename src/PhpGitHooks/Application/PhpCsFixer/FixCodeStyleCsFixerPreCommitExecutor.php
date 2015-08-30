<?php

namespace PhpGitHooks\Application\PhpCsFixer;

use PhpGitHooks\Application\Config\HookConfigExtraToolInterface;
use PhpGitHooks\Infrastructure\Common\InteractiveToolInterface;
use PhpGitHooks\Infrastructure\Common\PreCommitExecutor;
use PhpGitHooks\Infrastructure\PhpCsFixer\PhpCsFixerHandler;
use Symfony\Component\Console\Output\OutputInterface;

class FixCodeStyleCsFixerPreCommitExecutor extends PreCommitExecutor
{
    /** @var  PhpCsFixerHandler */
    private $phpCsFixerHandler;

    /**
     * @param HookConfigExtraToolInterface $hookConfigInterface
     * @param InteractiveToolInterface     $toolHandlerInterface
     */
    public function __construct(
        HookConfigExtraToolInterface $hookConfigInterface,
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
        $data = $this->preCommitConfig->extraOptions($this->commandName());

        if (true === $data['enabled']) {
            $this->phpCsFixerHandler->setOutput($output);
            $this->phpCsFixerHandler->setFiles($files);
            $this->phpCsFixerHandler->setLevel($data['level']);
            $this->phpCsFixerHandler->setFilesToAnalyze($needle);
            $this->phpCsFixerHandler->run();
        }
    }
}
