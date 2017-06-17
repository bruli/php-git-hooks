<?php

namespace PhpGitHooks\Module\Files\Tests\Behaviour;

use PhpGitHooks\Module\Files\Contract\Query\JsonFilesExtractor;
use PhpGitHooks\Module\Files\Contract\Query\JsonFilesExtractorHandler;
use PhpGitHooks\Module\Files\Contract\Response\JsonFilesResponse;
use PhpGitHooks\Module\Files\Tests\Infrastructure\FilesUnitTestCase;
use PhpGitHooks\Module\Git\Tests\Stub\FilesCommittedStub;

class JsonFilesExtractorHandlerTest extends FilesUnitTestCase
{
    /**
     * @test
     */
    public function itShouldReturnJsonFilesResponse()
    {
        $files = FilesCommittedStub::createAllFiles();

        $jsonFilesExtractorQueryHandler = new JsonFilesExtractorHandler();
        $jsonFilesResponse = $jsonFilesExtractorQueryHandler->handle(new JsonFilesExtractor($files));

        $this->assertInstanceOf(JsonFilesResponse::class, $jsonFilesResponse);
        $this->assertSame(1, count($jsonFilesResponse->getFiles()));
    }
}
