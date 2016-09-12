<?php

namespace PhpGitHooks\Module\PhpUnit\Service;

use PhpGitHooks\Module\Configuration\Domain\MinimumStrictCoverage;
use PhpGitHooks\Module\Git\Service\PreCommitOutputWriter;
use Symfony\Component\Console\Output\OutputInterface;

class StrictCoverageToolExecutor
{
    const EXECUTE_MESSAGE = 'Checking minimum coverage';
    /**
     * @var OutputInterface
     */
    private $output;
    /**
     * @var StrictCoverageTool
     */
    private $strictCoverageTool;

    /**
     * StrictCoverageToolExecutor constructor.
     * @param OutputInterface $output
     * @param StrictCoverageTool $strictCoverageTool
     */
    public function __construct(OutputInterface $output, StrictCoverageTool $strictCoverageTool)
    {
        $this->output = $output;
        $this->strictCoverageTool = $strictCoverageTool;
    }

    public function execute(MinimumStrictCoverage $minimumStrictCoverage, $errorMessage)
    {
        $outputMessage = new PreCommitOutputWriter(self::EXECUTE_MESSAGE);
        $this->output->write($outputMessage->getMessage());
        $currentCoverage = $this->strictCoverageTool->run($minimumStrictCoverage, $errorMessage);
        $this->output->writeln($outputMessage->getSuccessfulMessage() . $this->printCurrentCoverage($currentCoverage));
    }

    /**
     * @param $currentCoverage
     * @return string
     */
    private function printCurrentCoverage($currentCoverage)
    {
        return ' <comment>[' . round($currentCoverage, 0) . '%]</comment>';
    }
}
