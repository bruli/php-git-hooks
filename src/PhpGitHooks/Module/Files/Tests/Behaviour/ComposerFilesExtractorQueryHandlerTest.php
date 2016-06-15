<?php

namespace PhpGitHooks\Module\Files\Tests\Behaviour;

use PhpGitHooks\Module\Files\Contract\Query\ComposerFilesExtractorQuery;
use PhpGitHooks\Module\Files\Contract\QueryHandler\ComposerFilesExtractorQueryHandler;
use PhpGitHooks\Module\Files\Service\ComposerFilesExtractor;
use PhpGitHooks\Module\Files\Tests\Infrastructure\FilesUnitTestCase;
use PhpGitHooks\Module\Git\Tests\Stub\FilesCommittedStub;

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
