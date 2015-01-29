<?php

namespace PhpGitHooks\Application\PhpUnit;

use PhpGitHooks\Infrastructure\Common\PreCommitExecuter;
use PhpGitHooks\Application\Config\PreCommitConfig;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class UnitTestPreCommitExecuter
 * @package PhpGitHooks\Infrastructure\PhpUnit
 */
class UnitTestPreCommitExecuter extends PreCommitExecuter
{
    /** @var PhpUnitHandler  */
    private $phpunitHandler;

    /**
     * @param PreCommitConfig $preCommitConfig
     * @param PhpUnitHandler  $phpUnitHandler
     */
    public function __construct(PreCommitConfig $preCommitConfig, PhpUnitHandler $phpUnitHandler)
    {
        $this->preCommitConfig = $preCommitConfig;
        $this->phpunitHandler = $phpUnitHandler;
    }

    /**
     * @param  OutputInterface    $outputInterface
     * @throws UnitTestsException
     */
    public function run(OutputInterface $outputInterface)
    {
        if ($this->isEnabled()) {
            $this->phpunitHandler->setOutput($outputInterface);
            $this->phpunitHandler->run();
        }
    }

    /**
     * @return string
     */
    protected function commandName()
    {
        return 'phpunit';
    }
}
