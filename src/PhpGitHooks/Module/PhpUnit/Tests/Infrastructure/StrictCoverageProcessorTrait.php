<?php

namespace PhpGitHooks\Module\PhpUnit\Tests\Infrastructure;

use PhpGitHooks\Module\Configuration\Domain\MinimumStrictCoverage;
use PhpGitHooks\Module\PhpUnit\Model\StrictCoverageProcessorInterface;
use PhpGitHooks\Module\Tests\Infrastructure\UnitTestCase\Mock;
use PhpGitHooks\Module\Tests\Infrastructure\UnitTestCase\SimilarTo;

trait StrictCoverageProcessorTrait
{
    /**
     * @var StrictCoverageProcessorInterface
     */
    private $strictCoverageProcessor;

    /**
     * @return \Mockery\MockInterface|StrictCoverageProcessorInterface
     */
    protected function getStrictCoverageProcessor()
    {
        return $this->strictCoverageProcessor = $this->strictCoverageProcessor ?: Mock::get(
            StrictCoverageProcessorInterface::class
        );
    }

    /**
     * @param MinimumStrictCoverage $minimumStrictCoverage
     * @param float                 $return
     */
    protected function shouldProcessStrictCoverage(MinimumStrictCoverage $minimumStrictCoverage, $return)
    {
        $this->getStrictCoverageProcessor()
            ->shouldReceive('process')
            ->once()
            ->with((new SimilarTo())->compare($minimumStrictCoverage))
            ->andReturn($return);
    }
}
