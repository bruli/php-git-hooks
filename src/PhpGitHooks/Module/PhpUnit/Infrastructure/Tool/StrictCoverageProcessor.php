<?php

namespace PhpGitHooks\Module\PhpUnit\Infrastructure\Tool;

use PhpGitHooks\Infrastructure\Tool\ToolPathFinder;
use PhpGitHooks\Module\Configuration\Domain\MinimumStrictCoverage;
use PhpGitHooks\Module\PhpUnit\Model\StrictCoverageProcessorInterface;
use Symfony\Component\Process\Process;

class StrictCoverageProcessor implements StrictCoverageProcessorInterface
{
    /**
     * @var ToolPathFinder
     */
    private $toolPathFinder;

    /**
     * StrictCoverageProcessor constructor.
     *
     * @param ToolPathFinder $toolPathFinder
     */
    public function __construct(ToolPathFinder $toolPathFinder)
    {
        $this->toolPathFinder = $toolPathFinder;
    }

    /**
     * @param MinimumStrictCoverage $minimumStrictCoverage
     *
     * @return float
     */
    public function process(MinimumStrictCoverage $minimumStrictCoverage)
    {
        $command = sprintf(
            'php %s --coverage-text||grep Classes|cut -d " " -f 4|cut -d "%" -f 1',
            $this->toolPathFinder->find('phpunit')
        );

        $process = new Process($command);
        $process->run();

        return (float) $process->getOutput();
    }
}
