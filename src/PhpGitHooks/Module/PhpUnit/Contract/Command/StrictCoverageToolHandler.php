<?php

namespace PhpGitHooks\Module\PhpUnit\Contract\Command;

use Bruli\EventBusBundle\CommandBus\CommandHandlerInterface;
use Bruli\EventBusBundle\CommandBus\CommandInterface;
use PhpGitHooks\Module\Configuration\Domain\MinimumStrictCoverage;
use PhpGitHooks\Module\Git\Service\PreCommitOutputWriter;
use PhpGitHooks\Module\PhpUnit\Contract\Exception\InvalidStrictCoverageException;
use PhpGitHooks\Module\PhpUnit\Service\StrictCoverageTool;
use Symfony\Component\Console\Output\OutputInterface;

class StrictCoverageToolHandler implements CommandHandlerInterface
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

    /**
     * @param MinimumStrictCoverage $minimumStrictCoverage
     * @param string $errorMessage
     * @param bool $enableFaces
     *
     * @throws InvalidStrictCoverageException
     */
    private function execute(MinimumStrictCoverage $minimumStrictCoverage, $errorMessage, $enableFaces)
    {
        $outputMessage = new PreCommitOutputWriter(self::EXECUTE_MESSAGE);
        $this->output->write($outputMessage->getMessage());
        $currentCoverage = $this->strictCoverageTool->run($minimumStrictCoverage, $errorMessage, $enableFaces);
        $this->output->writeln($outputMessage->getSuccessfulMessage() . $this->printCurrentCoverage($currentCoverage));
    }

    /**
     * @param string $currentCoverage
     * @return string
     */
    private function printCurrentCoverage($currentCoverage)
    {
        return ' <comment>[' . round($currentCoverage, 0) . '%]</comment>';
    }

    /**
     * @param CommandInterface|StrictCoverage $command
     *
     * @throws InvalidStrictCoverageException
     */
    public function handle(CommandInterface $command)
    {
        $this->execute(
            new MinimumStrictCoverage($command->getMinimumCoverage()),
            $command->getErrorMessage(),
            $command->isEnableFaces()
        );
    }
}
