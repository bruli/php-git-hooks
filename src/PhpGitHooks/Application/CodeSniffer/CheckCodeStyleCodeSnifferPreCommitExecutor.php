<?php

namespace PhpGitHooks\Application\CodeSniffer;

use PhpGitHooks\Application\Config\HookConfigInterface;
use PhpGitHooks\Infrastructure\CodeSniffer\CodeSnifferHandler;
use PhpGitHooks\Infrastructure\CodeSniffer\InvalidCodingStandardException;
use PhpGitHooks\Infrastructure\Common\PreCommitExecutor;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class CheckCodeStyleCodeSnifferPreCommitExecutor.
 */
class CheckCodeStyleCodeSnifferPreCommitExecutor extends PreCommitExecutor
{
    /** @var  CodeSnifferHandler */
    private $codeSnifferHandler;

    /**
     * @param HookConfigInterface $preCommitConfig
     * @param CodeSnifferHandler  $codeSnifferHandler
     */
    public function __construct(HookConfigInterface $preCommitConfig, CodeSnifferHandler $codeSnifferHandler)
    {
        $this->preCommitConfig = $preCommitConfig;
        $this->codeSnifferHandler = $codeSnifferHandler;
    }

    /**
     * @param OutputInterface $output
     * @param array           $files
     * @param string          $needle
     *
     * @throws InvalidCodingStandardException
     */
    public function run(OutputInterface $output, array $files, $needle)
    {
        $data = $this->preCommitConfig->extraOptions($this->commandName());

        if (true === $data['enabled']) {
            $this->codeSnifferHandler->setOutput($output);
            $this->codeSnifferHandler->setFiles($files);
            $this->codeSnifferHandler->setNeddle($needle);
            $this->codeSnifferHandler->setStandard($data['standard']);
            if (isset($data['sniffs'])) {
                $this->codeSnifferHandler->setSniffs($data['sniffs']);

            }
            $this->codeSnifferHandler->run();
        }
    }

    /**
     * @return string
     */
    protected function commandName()
    {
        return 'phpcs';
    }
}
