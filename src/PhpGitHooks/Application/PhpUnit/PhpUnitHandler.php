<?php

namespace PhpGitHooks\Application\PhpUnit;

use PhpGitHooks\Command\BadJobLogo;
use PhpGitHooks\Command\OutputHandlerInterface;
use PhpGitHooks\Infrastructure\Common\ProcessBuilderInterface;
use PhpGitHooks\Infrastructure\Common\ToolHandler;
use PhpGitHooks\Infrastructure\PhpUnit\PhpUnitProcessBuilder;

/**
 * Class PhpUnitHandler.
 */
class PhpUnitHandler extends ToolHandler
{
    /** @var PhpUnitProcessBuilder  */
    private $phpUnitProcessBuilder;

    /**
     * @param OutputHandlerInterface  $outputHandler
     * @param ProcessBuilderInterface $processBuilderInterface
     */
    public function __construct(OutputHandlerInterface $outputHandler, ProcessBuilderInterface $processBuilderInterface)
    {
        parent::__construct($outputHandler);

        $this->phpUnitProcessBuilder = $processBuilderInterface;
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
            $this->output->writeln(BadJobLogo::paint());
            throw new UnitTestsException();
        }
    }

    protected function setTitle()
    {
        $this->outputHandler->setTitle('Running unit tests');
        $this->output->write($this->outputHandler->getTitle());
        $this->output->writeln($this->outputHandler->getSuccessfulStepMessage('Executing'));
    }
}
