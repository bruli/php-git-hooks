<?php

namespace Module\Files\Tests\Behaviour;

use Module\Files\Contract\Query\ComposerFilesExtractorQuery;
use Module\Files\Contract\QueryHandler\ComposerFilesExtractorQueryHandler;
use Module\Files\Service\ComposerFilesExtractor;
use Module\Files\Tests\Infrastructure\FilesUnitTestCase;
use Module\Git\Tests\Stub\FilesCommittedStub;

class ComposerFilesExtractorQueryHandlerTest extends FilesUnitTestCase
{
    /**
     * @test
     */
    public function itShouldReturnArrayComposerFilesResponse()
    {
        $files = FilesCommittedStub::createAllFiles();
        
        $composerFilesExtractorQueryHandler = new ComposerFilesExtractorQueryHandler(new ComposerFilesExtractor());
        $composerFilesResponse = $composerFilesExtractorQueryHandler->handle(new ComposerFilesExtractorQuery($files));

        $this->assertTrue($composerFilesResponse->isJsonFile());
        $this->assertTrue($composerFilesResponse->isLockFile());
    }
}
