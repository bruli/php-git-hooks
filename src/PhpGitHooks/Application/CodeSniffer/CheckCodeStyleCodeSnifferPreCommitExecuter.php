<?php

namespace PhpGitHooks\Application\CodeSniffer;

use PhpGitHooks\Infrastructure\CodeSniffer\CodeSnifferHandler;
use PhpGitHooks\Infrastructure\CodeSniffer\InvalidCodingStandardException;
use PhpGitHooks\Infrastructure\Common\PreCommitExecuter;
use PhpGitHooks\Application\Config\PreCommitConfig;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class CheckCodeStyleCodeSnifferPreCommitExecuter
 * @package PhpGitHooks\Infrastructure\CodeSniffer
 */
class CheckCodeStyleCodeSnifferPreCommitExecuter extends PreCommitExecuter
{
    /** @var  CodeSnifferHandler */
    private $codeSnifferHandler;

    /**
     * @param PreCommitConfig    $preCommitConfig
     * @param CodeSnifferHandler $codeSnifferHandler
     */
    public function __construct(PreCommitConfig $preCommitConfig, CodeSnifferHandler $codeSnifferHandler)
    {
        $this->preCommitConfig = $preCommitConfig;
        $this->codeSnifferHandler = $codeSnifferHandler;
    }

    /**
     * @param  OutputInterface                $output
     * @param  array                          $files
     * @param  string                         $needle
     * @throws InvalidCodingStandardException
     */
    public function run(OutputInterface $output, array $files, $needle)
    {
        if ($this->isEnabled()) {
            $this->codeSnifferHandler->setOutput($output);
            $this->codeSnifferHandler->setFiles($files);
            $this->codeSnifferHandler->setNeddle($needle);
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
