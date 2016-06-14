<?php

namespace Module\Files\Tests\Behaviour;

use Module\Files\Contract\Query\JsonFilesExtractorQuery;
use Module\Files\Contract\QueryHandler\JsonFilesExtractorQueryHandler;
use Module\Files\Contract\Response\JsonFilesResponse;
use Module\Files\Service\JsonFilesExtractor;
use Module\Files\Tests\Infrastructure\FilesUnitTestCase;
use Module\Git\Tests\Stub\FilesCommittedStub;

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
