<?php

namespace PhpGitHooks\Module\Files\Tests\Infrastructure;

use PhpGitHooks\Module\Files\Contract\Query\ComposerFilesExtractor;
use PhpGitHooks\Module\Files\Contract\Query\ComposerFilesExtractorHandler;
use PhpGitHooks\Module\Files\Contract\Response\ComposerFilesResponse;
use PhpGitHooks\Module\Tests\Infrastructure\UnitTestCase\Mock;
use PhpGitHooks\Module\Tests\Infrastructure\UnitTestCase\SimilarTo;

trait ComposerFilesExtractorQueryHandlerTrait
{
    /**
     * @var ComposerFilesExtractorHandler
     */
    private $composerFilesExtractorQueryHandler;

    /**
     * @return \Mockery\MockInterface|ComposerFilesExtractorHandler
     */
    protected function getComposerFilesExtractorQueryHandler()
    {
        return $this->composerFilesExtractorQueryHandler = $this->composerFilesExtractorQueryHandler ?: Mock::get(
            ComposerFilesExtractorHandler::class
        );
    }

    /**
     * @param ComposerFilesExtractor $composerFilesFilesExtractorQuery
     * @param ComposerFilesResponse       $return
     */
    protected function shouldHandleComposerFilesExtractorQuery(
        ComposerFilesExtractor $composerFilesFilesExtractorQuery,
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
