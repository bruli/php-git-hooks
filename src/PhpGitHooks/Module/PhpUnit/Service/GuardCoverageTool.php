<?php

namespace PhpGitHooks\Module\PhpUnit\Service;

use PhpGitHooks\Module\PhpUnit\Model\GuardCoverageFileReaderInterface;
use PhpGitHooks\Module\PhpUnit\Model\GuardCoverageFileWriterInterface;
use PhpGitHooks\Module\Git\Service\PreCommitOutputWriter;
use PhpGitHooks\Module\PhpUnit\Model\StrictCoverageProcessorInterface;
use Symfony\Component\Console\Output\OutputInterface;

class GuardCoverageTool
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
    public function run($warningMessage)
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
        ) : $this->output->writeln($outputMessage->getSuccessfulMessage());

        $this->guardWriter->write($this->currentCoverage);
    }

    /**
     * @return bool
     */
    private function isLowerCurrentCoverage()
    {
        return $this->currentCoverage < $this->previousCoverage;
    }
}
