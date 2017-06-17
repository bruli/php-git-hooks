<?php

namespace PhpGitHooks\Module\Files\Tests\Behaviour;

use PhpGitHooks\Module\Files\Contract\Query\ComposerFilesExtractor;
use PhpGitHooks\Module\Files\Contract\Query\ComposerFilesExtractorHandler;
use PhpGitHooks\Module\Files\Tests\Infrastructure\FilesUnitTestCase;
use PhpGitHooks\Module\Git\Tests\Stub\FilesCommittedStub;

class ComposerFilesExtractorHandlerTest extends FilesUnitTestCase
{
    /**
     * @test
     */
    public function itShouldReturnArrayComposerFilesResponse()
    {
        $files = FilesCommittedStub::createAllFiles();

        $composerFilesExtractorQueryHandler = new ComposerFilesExtractorHandler();
        $composerFilesResponse = $composerFilesExtractorQueryHandler->handle(new ComposerFilesExtractor($files));

        $this->assertTrue($composerFilesResponse->isJsonFile());
        $this->assertTrue($composerFilesResponse->isLockFile());
    }
}
