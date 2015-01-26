<?php

namespace PhpGitHooks\Infrastructure\PhpMD;

use PhpGitHooks\Infrastructure\Common\PreCommitExecuter;
use PhpGitHooks\Infrastructure\Config\PreCommitConfig;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class CheckPhpMessDetectionPreCommitExecuter
 * @package PhpGitHooks\Infrastructure\PhpMD
 */
class CheckPhpMessDetectionPreCommitExecuter extends PreCommitExecuter
{
    /** @var PhpMDHandler */
    private $phpMDHandler;

    /**
     * @param PreCommitConfig $preCommitConfig
     * @param PhpMDHandler    $phpMDHandler
     */
    public function __construct(PreCommitConfig $preCommitConfig, PhpMDHandler $phpMDHandler)
    {
        $this->phpMDHandler = $phpMDHandler;
        $this->preCommitConfig = $preCommitConfig;
    }

    /**
     * @return string
     */
    protected function commandName()
    {
        return 'phpmd';
    }

    /**
     * @param  OutputInterface          $output
     * @param  array                    $files
     * @param  string                   $needle
     * @throws PHPMDViolationsException
     */
    public function run(OutputInterface $output, array $files, $needle)
    {
        if ($this->isEnabled()) {
            $this->phpMDHandler->setOutput($output);
            $this->phpMDHandler->setFiles($files);
            $this->phpMDHandler->setNeedle($needle);
            $this->phpMDHandler->run();
        }
    }
}
