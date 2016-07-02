<?php

namespace PhpGitHooks\Module\PhpUnit\Tests\Infrastructure;

use PhpGitHooks\Module\PhpUnit\Model\GuardCoverageFileReaderInterface;
use PhpGitHooks\Module\Tests\Infrastructure\UnitTestCase\Mock;

trait GuardCoverageFileReaderTrait
{
    /**
     * @var GuardCoverageFileReaderInterface
     */
    private $guardCoverageFileReader;

    /**
     * @return \Mockery\MockInterface|GuardCoverageFileReaderInterface
     */
    protected function getGuardCoverageFileReader()
    {
        return $this->guardCoverageFileReader = $this->guardCoverageFileReader ?: Mock::get(
            GuardCoverageFileReaderInterface::class
        );
    }

    /**
     * @param float $return
     */
    protected function shouldReadGuardCoverage($return)
    {
        $this->getGuardCoverageFileReader()
            ->shouldReceive('read')
            ->once()
            ->andReturn($return);
    }
}
