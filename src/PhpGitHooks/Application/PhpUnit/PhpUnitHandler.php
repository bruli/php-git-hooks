<?php

namespace PhpGitHooks\Application\PhpUnit;

use PhpGitHooks\Command\OutputHandler;
use PhpGitHooks\Infrastructure\Common\ToolHandler;
use PhpGitHooks\Infrastructure\PhpUnit\PhpUnitProcessBuilder;

/**
 * Class PhpUnitHandler
 * @package PhpGitHooks\Application\PhpUnit
 */
class PhpUnitHandler extends ToolHandler
{
    /** @var PhpUnitProcessBuilder  */
    private $phpUnitProcessBuilder;

    /**
     * @param OutputHandler         $outputHandler
     * @param PhpUnitProcessBuilder $phpUnitProcessBuilder
     */
    public function __construct(OutputHandler $outputHandler, PhpUnitProcessBuilder $phpUnitProcessBuilder)
    {
        parent::__construct($outputHandler);

        $this->phpUnitProcessBuilder = $phpUnitProcessBuilder;
    }

    /**
     * @throws UnitTestsException
     */
    public function run()
    {
        $this->setTitle();

        $processBuilder = $this->phpUnitProcessBuilder->getProcessBuilder();
        $processBuilder->setTimeout(3600);
        $phpunit = $processBuilder->getProcess();
        $this->phpUnitProcessBuilder
            ->executeProcess($phpunit, $this->output);

        if (!$phpunit->isSuccessful()) {
            throw new UnitTestsException();
        }
    }

    private function setTitle()
    {
        $this->outputHandler->setTitle('Running unit tests');
        $this->output->write($this->outputHandler->getTitle());
        $this->output->writeln($this->outputHandler->getSuccessfulStepMessage('Executing'));
    }
}
