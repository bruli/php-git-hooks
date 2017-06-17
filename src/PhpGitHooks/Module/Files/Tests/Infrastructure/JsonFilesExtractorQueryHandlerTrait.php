<?php

namespace PhpGitHooks\Module\Files\Tests\Infrastructure;

use PhpGitHooks\Module\Files\Contract\Query\JsonFilesExtractorQuery;
use PhpGitHooks\Module\Files\Contract\Query\JsonFilesExtractorQueryHandler;
use PhpGitHooks\Module\Files\Contract\Response\JsonFilesResponse;
use PhpGitHooks\Module\Tests\Infrastructure\UnitTestCase\Mock;
use PhpGitHooks\Module\Tests\Infrastructure\UnitTestCase\SimilarTo;

trait JsonFilesExtractorQueryHandlerTrait
{
    /**
     * @var JsonFilesExtractorQueryHandler
     */
    private $jsonFilesExtractorQueryHandler;

    /**
     * @return \Mockery\MockInterface|JsonFilesExtractorQueryHandler
     */
    protected function getJsonFilesExtractorQueryHandler()
    {
        return $this->jsonFilesExtractorQueryHandler = $this->jsonFilesExtractorQueryHandler ?: Mock::get(
            JsonFilesExtractorQueryHandler::class
        );
    }

    /**
     * @param JsonFilesExtractorQuery $jsonFilesExtractorQuery
     * @param JsonFilesResponse       $return
     */
    protected function shouldHandleJsonFilesExtractorQuery(
        JsonFilesExtractorQuery $jsonFilesExtractorQuery,
        JsonFilesResponse $return
    ) {
        $this->getJsonFilesExtractorQueryHandler()
             ->shouldReceive('handle')
             ->once()
             ->with((new SimilarTo())->compare($jsonFilesExtractorQuery))
             ->andReturn($return)
        ;
    }
}
