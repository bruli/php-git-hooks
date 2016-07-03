<?php

namespace PhpGitHooks\Module\PhpUnit\Tests\Infrastructure;

use PhpGitHooks\Module\PhpUnit\Model\StrictCoverageProcessorInterface;
use PhpGitHooks\Module\Tests\Infrastructure\UnitTestCase\Mock;

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
     * @param float $return
     */
    protected function shouldProcessStrictCoverage($return)
    {
        $this->getStrictCoverageProcessor()
            ->shouldReceive('process')
            ->once()
            ->andReturn($return);
    }
}
