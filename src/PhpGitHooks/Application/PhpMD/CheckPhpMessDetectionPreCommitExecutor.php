<?php

namespace PhpGitHooks\Application\PhpMD;

use PhpGitHooks\Application\Config\HookConfigInterface;
use PhpGitHooks\Infrastructure\Common\PreCommitExecutor;
use PhpGitHooks\Infrastructure\Common\RecursiveToolInterface;
use PhpGitHooks\Infrastructure\PhpMD\PhpMDHandler;
use PhpGitHooks\Infrastructure\PhpMD\PHPMDViolationsException;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class CheckPhpMessDetectionPreCommitExecutor.
 */
class CheckPhpMessDetectionPreCommitExecutor extends PreCommitExecutor
{
    /** @var PhpMDHandler */
    private $phpMDHandler;

    /**
     * @param HookConfigInterface    $hookConfigInterface
     * @param RecursiveToolInterface $recursiveToolInterface
     */
    public function __construct(
        HookConfigInterface $hookConfigInterface,
        RecursiveToolInterface $recursiveToolInterface
    ) {
        $this->phpMDHandler = $recursiveToolInterface;
        $this->preCommitConfig = $hookConfigInterface;
    }

    /**
     * @return string
     */
    protected function commandName()
    {
        return 'phpmd';
    }

    /**
     * @param OutputInterface $output
     * @param array           $files
     * @param string          $needle
     *
     * @throws PHPMDViolationsException
     */
    public function run(OutputInterface $output, array $files, $needle)
    {
        if ($this->isEnabled()) {
            $this->phpMDHandler->setOutput($output);
            $this->phpMDHandler->setFiles($files);
            $this->phpMDHandler->setNeedle($needle);
            $this->phpMDHandler->run($this->getMessages());
        }
    }
}
