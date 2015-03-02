<?php

namespace PhpGitHooks\Application\PhpUnit;

use PhpGitHooks\Application\Config\HookConfigInterface;
use PhpGitHooks\Infrastructure\Common\PreCommitExecuter;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class UnitTestPreCommitExecuter.
 */
class UnitTestPreCommitExecuter extends PreCommitExecuter
{
    /** @var PhpUnitHandler  */
    private $phpunitHandler;

    /**
     * @param HookConfigInterface $hookConfigInterface
     * @param PhpUnitHandler      $phpUnitHandler
     */
    public function __construct(HookConfigInterface $hookConfigInterface, PhpUnitHandler $phpUnitHandler)
    {
        $this->preCommitConfig = $hookConfigInterface;
        $this->phpunitHandler = $phpUnitHandler;
    }

    /**
     * @param OutputInterface $outputInterface
     *
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
