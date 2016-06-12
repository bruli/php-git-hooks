<?php

namespace Module\Files\Tests\Behaviour;

use Module\Files\Contract\Query\PhpFilesExtractorQuery;
use Module\Files\Contract\QueryHandler\PhpFilesExtractorQueryHandler;
use Module\Files\Contract\Response\PhpFilesResponse;
use Module\Files\Service\PhpFilesExtractor;
use Module\Files\Tests\Infrastructure\FilesUnitTestCase;
use Module\Git\Tests\Stub\FilesCommittedStub;

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
    public function itShouldReturnArrayPhpFiles()
    {
        $files = $this->phpFilesExtractorQueryHandler->handle(
            new PhpFilesExtractorQuery(FilesCommittedStub::createAllFiles())
        );

        $this->assertInstanceOf(PhpFilesResponse::class, $files);
        $this->assertSame(5, count($files->getFiles()));
    }
}
