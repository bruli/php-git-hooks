<?php

namespace PhpGitHooks\Module\Files\Tests\Behaviour;

use PhpGitHooks\Module\Files\Contract\Query\JsonFilesExtractorQuery;
use PhpGitHooks\Module\Files\Contract\QueryHandler\JsonFilesExtractorQueryHandler;
use PhpGitHooks\Module\Files\Contract\Response\JsonFilesResponse;
use PhpGitHooks\Module\Files\Service\JsonFilesExtractor;
use PhpGitHooks\Module\Files\Tests\Infrastructure\FilesUnitTestCase;
use PhpGitHooks\Module\Git\Tests\Stub\FilesCommittedStub;

class JsonFilesExtractorQueryHandlerTest extends FilesUnitTestCase
{
    /**
     * @test
     */
    public function itShouldReturnJsonFilesResponse()
    {
        $files = FilesCommittedStub::createAllFiles();

        $jsonFilesExtractorQueryHandler = new JsonFilesExtractorQueryHandler(new JsonFilesExtractor());
        $jsonFilesResponse = $jsonFilesExtractorQueryHandler->handle(new JsonFilesExtractorQuery($files));

        $this->assertInstanceOf(JsonFilesResponse::class, $jsonFilesResponse);
        $this->assertSame(1, count($jsonFilesResponse->getFiles()));
    }
}
