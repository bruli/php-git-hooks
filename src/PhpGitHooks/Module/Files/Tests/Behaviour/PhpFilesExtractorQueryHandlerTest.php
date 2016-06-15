<?php

namespace PhpGitHooks\Module\Files\Tests\Behaviour;

use PhpGitHooks\Module\Files\Contract\Query\PhpFilesExtractorQuery;
use PhpGitHooks\Module\Files\Contract\QueryHandler\PhpFilesExtractorQueryHandler;
use PhpGitHooks\Module\Files\Contract\Response\PhpFilesResponse;
use PhpGitHooks\Module\Files\Service\PhpFilesExtractor;
use PhpGitHooks\Module\Files\Tests\Infrastructure\FilesUnitTestCase;
use PhpGitHooks\Module\Git\Tests\Stub\FilesCommittedStub;

class PhpFilesExtractorQueryHandlerTest extends FilesUnitTestCase
{
    /**
     * @var PhpFilesExtractorQueryHandler
     */
    private $phpFilesExtractorQueryHandler;

    protected function setUp()
    {
        $this->phpFilesExtractorQueryHandler = new PhpFilesExtractorQueryHandler(new PhpFilesExtractor());
    }

    /**
     * @test
     */
    public function itShouldReturnArrayPhpFilesResponse()
    {
        $files = $this->phpFilesExtractorQueryHandler->handle(
            new PhpFilesExtractorQuery(FilesCommittedStub::createAllFiles())
        );

        $this->assertInstanceOf(PhpFilesResponse::class, $files);
        $this->assertSame(5, count($files->getFiles()));
    }
}
