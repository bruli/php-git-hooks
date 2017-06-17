<?php

namespace PhpGitHooks\Module\Files\Tests\Behaviour;

use PhpGitHooks\Module\Files\Contract\Query\PhpFilesExtractor;
use PhpGitHooks\Module\Files\Contract\Query\PhpFilesExtractorHandler;
use PhpGitHooks\Module\Files\Contract\Response\PhpFilesResponse;
use PhpGitHooks\Module\Files\Tests\Infrastructure\FilesUnitTestCase;
use PhpGitHooks\Module\Git\Tests\Stub\FilesCommittedStub;

class PhpFilesExtractorQueryHandlerTest extends FilesUnitTestCase
{
    /**
     * @var PhpFilesExtractorHandler
     */
    private $phpFilesExtractorQueryHandler;

    protected function setUp()
    {
        $this->phpFilesExtractorQueryHandler = new PhpFilesExtractorHandler();
    }

    /**
     * @test
     */
    public function itShouldReturnArrayPhpFilesResponse()
    {
        $files = $this->phpFilesExtractorQueryHandler->handle(
            new PhpFilesExtractor(FilesCommittedStub::createAllFiles())
        );

        $this->assertInstanceOf(PhpFilesResponse::class, $files);
        $this->assertSame(5, count($files->getFiles()));
    }
}
