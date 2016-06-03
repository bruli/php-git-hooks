<?php


namespace Module\Git\Tests\Infrastructure;


use Module\Git\Infrastructure\Files\FilesCommittedExtractor;
use Module\Tests\Infrastructure\UnitTestCase\Mock;

trait FilesCommittedExtractorTrait
{
    /**
     * @var FilesCommittedExtractor
     */
    private $filesCommittedExtractor;

    /**
     * @return \Mockery\MockInterface|FilesCommittedExtractor
     */
    protected function getFilesCommittedExtractor()
    {
        return $this->filesCommittedExtractor = $this->filesCommittedExtractor ?: Mock::get(
            FilesCommittedExtractor::class
        );
    }
}