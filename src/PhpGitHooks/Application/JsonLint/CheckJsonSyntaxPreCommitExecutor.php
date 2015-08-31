<?php

namespace PhpGitHooks\Application\JsonLint;

use PhpGitHooks\Application\Config\HookConfigInterface;
use PhpGitHooks\Infrastructure\Common\PreCommitExecutor;
use PhpGitHooks\Infrastructure\Common\RecursiveToolInterface;
use Symfony\Component\Console\Output\OutputInterface;

final class CheckJsonSyntaxPreCommitExecutor extends PreCommitExecutor
{
    /** @var  RecursiveToolInterface */
    private $jsonLintHandler;

    /**
     * @param RecursiveToolInterface $jsonLintHandler
     * @param HookConfigInterface    $hookConfigInterface
     */
    public function __construct(
        RecursiveToolInterface $jsonLintHandler,
        HookConfigInterface $hookConfigInterface
    ) {
        $this->jsonLintHandler = $jsonLintHandler;
        $this->preCommitConfig = $hookConfigInterface;
    }

    /**
     * @return string
     */
    protected function commandName()
    {
        return 'jsonlint';
    }

    public function run(OutputInterface $outputInterface, array $files, $needle)
    {
        if (true === $this->isEnabled()) {
            $this->jsonLintHandler->setOutput($outputInterface);
            $this->jsonLintHandler->setFiles($files);
            $this->jsonLintHandler->setNeedle($needle);
            $this->jsonLintHandler->run();
        }
    }
}
