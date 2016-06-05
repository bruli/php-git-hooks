<?php

namespace Module\Files\Tests\Infrastructure;

use Module\Files\Contract\Query\ComposerFilesExtractorQuery;
use Module\Files\Contract\QueryHandler\ComposerFilesExtractorQueryHandler;
use Module\Files\Contract\Response\ComposerFilesResponse;
use Module\Tests\Infrastructure\UnitTestCase\Mock;
use Module\Tests\Infrastructure\UnitTestCase\SimilarTo;

trait ComposerFilesExtractorQueryHandlerTrait
{
    /**
     * @var ComposerFilesExtractorQueryHandler
     */
    private $composerFilesExtractorQueryHandler;

    /**
     * @return \Mockery\MockInterface|ComposerFilesExtractorQueryHandler
     */
    protected function getComposerFilesExtractorQueryHandler()
    {
        return $this->composerFilesExtractorQueryHandler = $this->composerFilesExtractorQueryHandler ?: Mock::get(
            ComposerFilesExtractorQueryHandler::class
        );
    }

    /**
     * @param ComposerFilesExtractorQuery $composerFilesFilesExtractorQuery
     * @param ComposerFilesResponse            $return
     */
    protected function shouldHandleComposerFilesExtractorQuery(
        ComposerFilesExtractorQuery $composerFilesFilesExtractorQuery,
        ComposerFilesResponse $return
    ) {
        $this->getComposerFilesExtractorQueryHandler()
             ->shouldReceive('handle')
             ->once()
             ->with((new SimilarTo())->compare($composerFilesFilesExtractorQuery))
             ->andReturn($return)
        ;
    }
}
