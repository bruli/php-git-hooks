<?php

namespace PhpGitHooks\Application\PhpUnit;

use PhpGitHooks\Application\Config\HookConfigExtraToolInterface;
use PhpGitHooks\Application\Config\HookConfigInterface;
use PhpGitHooks\Infrastructure\Common\PreCommitExecutor;
use Symfony\Component\Console\Output\OutputInterface;

class UnitTestPreCommitExecutor extends PreCommitExecutor
{
    /** @var PhpUnitHandler */
    private $phpunitHandler;
    /** @var PhpUnitRandomizerHandler */
    private $phpUnitRandomizerHandler;

    /**
     * @param HookConfigInterface      $hookConfigInterface
     * @param PhpUnitHandler           $phpUnitHandler
     * @param PhpUnitRandomizerHandler $phpUnitRandomizerHandler
     */
    public function __construct(
        HookConfigInterface $hookConfigInterface,
        PhpUnitHandler $phpUnitHandler,
        PhpUnitRandomizerHandler $phpUnitRandomizerHandler
    ) {
        $this->preCommitConfig = $hookConfigInterface;
        $this->phpunitHandler = $phpUnitHandler;
        $this->phpUnitRandomizerHandler = $phpUnitRandomizerHandler;
    }

    /**
     * @param OutputInterface $outputInterface
     *
     * @throws UnitTestsException
     */
    public function run(OutputInterface $outputInterface)
    {
        /** @var HookConfigExtraToolInterface $data */
        $data = $this->preCommitConfig;
        $extraOptions = $data->extraOptions(PhpUnitConfigData::TOOL);
        if (true === $extraOptions['enabled']) {
            if (true === $extraOptions['random-mode']) {
                $this->phpUnitRandomizerHandler->setOutput($outputInterface);
                $this->phpUnitRandomizerHandler->run($this->getMessages());
            } else {
                $this->phpunitHandler->setOutput($outputInterface);
                $this->phpunitHandler->run($this->getMessages());
            }
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
