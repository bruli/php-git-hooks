<?php

namespace PhpGitHooks\Application\PhpCsFixer;

use PhpGitHooks\Infrastructure\Common\PreCommitExecuter;
use PhpGitHooks\Application\Config\PreCommitConfig;
use PhpGitHooks\Infrastructure\PhpCsFixer\PhpCsFixerHandler;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class FixCodeStyleCsFixerPreCommitExecuter
 * @package PhpGitHooks\Infrastructure\PhpCsFixer
 */
class FixCodeStyleCsFixerPreCommitExecuter extends PreCommitExecuter
{
    /** @var  PhpCsFixerHandler */
    private $phpCsFixerHandler;

    /**
     * @param PreCommitConfig   $preCommitConfig
     * @param PhpCsFixerHandler $csFixerHandler
     */
    public function __construct(PreCommitConfig $preCommitConfig, PhpCsFixerHandler $csFixerHandler)
    {
        $this->preCommitConfig = $preCommitConfig;
        $this->phpCsFixerHandler = $csFixerHandler;
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
