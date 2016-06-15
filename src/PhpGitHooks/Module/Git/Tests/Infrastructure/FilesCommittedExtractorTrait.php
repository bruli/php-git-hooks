<?php

namespace PhpGitHooks\Module\Git\Tests\Infrastructure;

use PhpGitHooks\Module\Git\Infrastructure\Files\FilesCommittedExtractor;
use PhpGitHooks\Module\Tests\Infrastructure\UnitTestCase\Mock;

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

    /**
     * @param array $return
     */
    protected function shouldGetFilesCommitted(array $return)
    {
        $this->getFilesCommittedExtractor()
             ->shouldReceive('getFiles')
             ->once()
             ->andReturn($return);
    }
}
