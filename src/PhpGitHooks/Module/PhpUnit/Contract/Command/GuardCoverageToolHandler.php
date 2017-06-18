<?php

namespace PhpGitHooks\Module\PhpUnit\Contract\Command;

use Bruli\EventBusBundle\CommandBus\CommandHandlerInterface;
use Bruli\EventBusBundle\CommandBus\CommandInterface;
use PhpGitHooks\Module\Git\Service\PreCommitOutputWriter;
use PhpGitHooks\Module\PhpUnit\Contract\Command\GuardCoverage;
use PhpGitHooks\Module\PhpUnit\Model\GuardCoverageFileReaderInterface;
use PhpGitHooks\Module\PhpUnit\Model\GuardCoverageFileWriterInterface;
use PhpGitHooks\Module\PhpUnit\Model\StrictCoverageProcessorInterface;
use Symfony\Component\Console\Output\OutputInterface;

class GuardCoverageToolHandler implements CommandHandlerInterface
{
    const CHECKING_MESSAGE = 'Checking your current coverage';
    /**
     * @var OutputInterface
     */
    private $output;
    /**
     * @var StrictCoverageProcessorInterface
     */
    private $strictCoverageProcessor;
    /**
     * @var GuardCoverageFileReaderInterface
     */
    private $guardReader;
    /**
     * @var GuardCoverageFileWriterInterface
     */
    private $guardWriter;
    /**
     * @var float;
     */
    private $currentCoverage;
    /**
     * @var float
     */
    private $previousCoverage;

    /**
     * GuardCoverageTool constructor.
     *
     * @param OutputInterface $output
     * @param StrictCoverageProcessorInterface $strictCoverageProcessor
     * @param GuardCoverageFileReaderInterface $guardReader
     * @param GuardCoverageFileWriterInterface $guardWriter
     */
    public function __construct(
        OutputInterface $output,
        StrictCoverageProcessorInterface $strictCoverageProcessor,
        GuardCoverageFileReaderInterface $guardReader,
        GuardCoverageFileWriterInterface $guardWriter
    ) {
        $this->output = $output;
        $this->strictCoverageProcessor = $strictCoverageProcessor;
        $this->guardReader = $guardReader;
        $this->guardWriter = $guardWriter;
    }

    /**
     * @param string $warningMessage
     */
    private function run($warningMessage)
    {
        $outputMessage = new PreCommitOutputWriter(self::CHECKING_MESSAGE);
        $this->output->write($outputMessage->getMessage());

        $this->currentCoverage = $this->strictCoverageProcessor->process();
        $this->previousCoverage = $this->guardReader->read();


        true === $this->isLowerCurrentCoverage() ? $this->output->writeln(
            sprintf(
                "\n<bg=yellow;options=bold>%s Previous coverage %s, current coverage %s.</>",
                $warningMessage,
                $this->previousCoverage,
                $this->currentCoverage
            )
        ) : $this->output->writeln(
            $outputMessage->getSuccessfulMessage() . $this->printGuardCoverage()
        );

        $this->guardWriter->write($this->currentCoverage);
    }

    /**
     * @return bool
     */
    private function isLowerCurrentCoverage()
    {
        return $this->currentCoverage < $this->previousCoverage;
    }

    /**
     * @return string
     */
    private function printGuardCoverage()
    {
        return ' <comment>[' .
            round($this->currentCoverage, 0) .
            '% >= ' .
            round($this->previousCoverage, 0) .
            '%]</comment>';
    }

    /**
     * @param CommandInterface|GuardCoverage $command
     */
    public function handle(CommandInterface $command)
    {
        $this->run($command->getWarningMessage());
    }
}
