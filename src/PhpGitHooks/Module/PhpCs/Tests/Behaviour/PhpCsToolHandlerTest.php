<?php

namespace PhpGitHooks\Module\PhpCs\Tests\Behaviour;

use PhpGitHooks\Module\Configuration\Service\HookQuestions;
use PhpGitHooks\Module\Git\Contract\Response\BadJobLogoResponse;
use PhpGitHooks\Module\Git\Service\PreCommitOutputWriter;
use PhpGitHooks\Module\Git\Tests\Stub\FilesCommittedStub;
use PhpGitHooks\Module\PhpCs\Contract\Command\PhpCsTool;
use PhpGitHooks\Module\PhpCs\Contract\Command\PhpCsToolHandler;
use PhpGitHooks\Module\PhpCs\Contract\Exception\PhpCsViolationException;
use PhpGitHooks\Module\PhpCs\Tests\Infrastructure\PhpCsUnitTestCase;

class PhpCsToolHandlerTest extends PhpCsUnitTestCase
{
    /**
     * @var PhpCsToolHandler
     */
    private $phpCsToolCommandHandler;

    protected function setUp()
    {
        $this->phpCsToolCommandHandler = new PhpCsToolHandler(
            $this->getOutputInterface(),
            $this->getPhpCsToolProcessor()
        );
    }

    /**
     * @test
     */
    public function itShouldThrowsException()
    {
        $this->expectException(PhpCsViolationException::class);

        $output = new PreCommitOutputWriter(PhpCsToolHandler::EXECUTE_MESSAGE);
        $files = FilesCommittedStub::createOnlyPhpFiles();

        $this->shouldWriteOutput($output->getMessage());

        $errorTxt = null;
        foreach ($files as $file) {
            $error = 'ERROR-';
            $this->shouldProcessPhpCsTool($file, 'PSR2', '', $error);
            $errorTxt .= $error;
        }

        $this->shouldWriteLnOutput($output->getFailMessage());
        $this->shouldWriteLnOutput($output->setError($errorTxt));
        $this->shouldWriteLnOutput(BadJobLogoResponse::paint(HookQuestions::PRE_COMMIT_ERROR_MESSAGE_DEFAULT));

        $this->phpCsToolCommandHandler->handle(
            new PhpCsTool(
                $files,
                'PSR2',
                HookQuestions::PRE_COMMIT_ERROR_MESSAGE_DEFAULT,
                ''
            )
        );
    }

    /**
     * @test
     */
    public function itShouldWorksFine()
    {
        $output = new PreCommitOutputWriter(PhpCsToolHandler::EXECUTE_MESSAGE);
        $files = FilesCommittedStub::createOnlyPhpFiles();

        $this->shouldWriteOutput($output->getMessage());

        foreach ($files as $file) {
            $this->shouldProcessPhpCsTool($file, 'PSR2', '', null);
        }

        $this->shouldWriteLnOutput($output->getSuccessfulMessage());

        $this->phpCsToolCommandHandler->handle(
            new PhpCsTool(
                $files,
                'PSR2',
                HookQuestions::PRE_COMMIT_ERROR_MESSAGE_DEFAULT,
                ''
            )
        );
    }
}
