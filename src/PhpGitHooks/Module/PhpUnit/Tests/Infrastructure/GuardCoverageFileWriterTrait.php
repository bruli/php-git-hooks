<?php

namespace PhpGitHooks\Module\PhpUnit\Tests\Infrastructure;

use PhpGitHooks\Module\PhpUnit\Model\GuardCoverageFileWriterInterface;
use PhpGitHooks\Module\Tests\Infrastructure\UnitTestCase\Mock;

trait GuardCoverageFileWriterTrait
{
    /**
     * @var GuardCoverageFileWriterInterface
     */
    private $guardCoverageFileWriter;

    /**
     * @return \Mockery\MockInterface|GuardCoverageFileWriterInterface
     */
    protected function getGuardCoverageFileWriter()
    {
        return $this->guardCoverageFileWriter = $this->guardCoverageFileWriter ?: Mock::get(
            GuardCoverageFileWriterInterface::class
        );
    }

    /**
     * @param float $data
     */
    protected function shouldWriteGuardCoverage($data)
    {
        $this->getGuardCoverageFileWriter()
            ->shouldReceive('write')
            ->once()
            ->with($data);
    }
}
