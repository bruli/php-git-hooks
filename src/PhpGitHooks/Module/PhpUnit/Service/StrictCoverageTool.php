<?php

namespace PhpGitHooks\Module\PhpUnit\Service;

use PhpGitHooks\Module\Configuration\Domain\MinimumStrictCoverage;
use PhpGitHooks\Module\Git\Contract\Response\BadJobLogoResponse;
use PhpGitHooks\Module\PhpUnit\Contract\Exception\InvalidStrictCoverageException;
use PhpGitHooks\Module\PhpUnit\Model\StrictCoverageProcessorInterface;
use Symfony\Component\Console\Output\OutputInterface;

class StrictCoverageTool
{
    /**
     * @var StrictCoverageProcessorInterface
     */
    private $strictCoverageProcessor;
    /**
     * @var OutputInterface
     */
    private $output;

    /**
     * StrictCoverageTool constructor.
     *
     * @param StrictCoverageProcessorInterface $strictCoverageProcessor
     * @param OutputInterface                  $output
     */
    public function __construct(StrictCoverageProcessorInterface $strictCoverageProcessor, OutputInterface $output)
    {
        $this->strictCoverageProcessor = $strictCoverageProcessor;
        $this->output = $output;
    }

    /**
     * @param MinimumStrictCoverage $minimumStrictCoverage
     * @param string                $errorMessage
     *
     * @throws InvalidStrictCoverageException
     */
    public function run(MinimumStrictCoverage $minimumStrictCoverage, $errorMessage)
    {
        $currentCoverage = $this->strictCoverageProcessor->process($minimumStrictCoverage);
        if ($minimumStrictCoverage->value() > $currentCoverage) {
            $this->output->writeln(BadJobLogoResponse::paint($errorMessage));

            throw new InvalidStrictCoverageException($currentCoverage, $minimumStrictCoverage->value());
        }
    }
}
