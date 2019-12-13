<?php

namespace PhpGitHooks\Module\PhpCsFixer\Tests\Behaviour;

use PhpGitHooks\Module\Configuration\Tests\Stub\ConfigurationDataResponseStub;
use PhpGitHooks\Module\Configuration\Tests\Stub\PhpCsFixerOptionsStub;
use PhpGitHooks\Module\Git\Contract\Response\BadJobLogoResponse;
use PhpGitHooks\Module\Git\Service\PreCommitOutputWriter;
use PhpGitHooks\Module\Git\Tests\Stub\FilesCommittedStub;
use PhpGitHooks\Module\PhpCsFixer\Contract\Command\PhpCsFixerTool;
use PhpGitHooks\Module\PhpCsFixer\Contract\Command\PhpCsFixerToolHandler;
use PhpGitHooks\Module\PhpCsFixer\Contract\Exception\PhpCsFixerViolationsException;
use PhpGitHooks\Module\PhpCsFixer\Tests\Infrastructure\PhpCsFixerUnitTestCase;

class PhpCsFixerToolHandlerTest extends PhpCsFixerUnitTestCase
{
    /**
     * @var PhpCsFixerToolHandler
     */
    private $phpCsFixerToolCommandHandler;

    protected function setUp(): void
    {
        $this->phpCsFixerToolCommandHandler = new PhpCsFixerToolHandler(
            $this->getOutputInterface(),
            $this->getPhpCsFixerToolProcessor()
        );
    }

    /**
     * @test
     */
    public function itShouldThrowsException()
    {
        $this->expectException(PhpCsFixerViolationsException::class);

        $phpCsFixerOptions = PhpCsFixerOptionsStub::random();
        $configurationData = ConfigurationDataResponseStub::createAllEnabled();
        $phpFiles = FilesCommittedStub::createOnlyPhpFiles();

        $outputMessage = new PreCommitOutputWriter('Checking PSR0 code style with PHP-CS-FIXER');
        $this->shouldWriteOutput($outputMessage->getMessage());

        $errors = null;
        foreach ($phpFiles as $file) {
            $errorText = 'ERROR';
            $this->shouldProcessPhpCsFixerTool($file, '@PSR0', $phpCsFixerOptions->value(), $errorText);
            $errors .= $errorText;
        }

        $this->shouldWriteLnOutput($outputMessage->getFailMessage());
        $this->shouldWriteLnOutput($outputMessage->setError($errors));
        $this->shouldWriteLnOutput(
            BadJobLogoResponse::paint(
                $configurationData->getPreCommit()->getErrorMessage(),
                $configurationData->getPreCommit()->isEnableFaces()
            )
        );

        $this->phpCsFixerToolCommandHandler->handle(
            new PhpCsFixerTool(
                $phpFiles,
                $configurationData->getPreCommit()->getPhpCsFixer()->isPhpCsFixerPsr0(),
                $configurationData->getPreCommit()->getPhpCsFixer()->isPhpCsFixerPsr1(),
                $configurationData->getPreCommit()->getPhpCsFixer()->isPhpCsFixerPsr2(),
                $configurationData->getPreCommit()->getPhpCsFixer()->isPhpCsFixerSymfony(),
                $phpCsFixerOptions->value(),
                $configurationData->getPreCommit()->getErrorMessage(),
                $configurationData->getPreCommit()->isEnableFaces()
            )
        );
    }

    /**
     * @test
     */
    public function itShouldWorksFine()
    {
        $phpCsFixerOptions = PhpCsFixerOptionsStub::random();
        $configurationData = ConfigurationDataResponseStub::createAllEnabled();
        $phpFiles = FilesCommittedStub::createOnlyPhpFiles();

        $outputMessagePsr0 = new PreCommitOutputWriter('Checking PSR0 code style with PHP-CS-FIXER');
        $this->shouldWriteOutput($outputMessagePsr0->getMessage());

        foreach ($phpFiles as $file) {
            $this->shouldProcessPhpCsFixerTool($file, '@PSR0', $phpCsFixerOptions->value(), null);
        }

        $this->shouldWriteLnOutput($outputMessagePsr0->getSuccessfulMessage());

        $outputMessagePsr1 = new PreCommitOutputWriter('Checking PSR1 code style with PHP-CS-FIXER');
        $this->shouldWriteOutput($outputMessagePsr1->getMessage());

        foreach ($phpFiles as $file) {
            $this->shouldProcessPhpCsFixerTool($file, '@PSR1', $phpCsFixerOptions->value(), null);
        }

        $this->shouldWriteLnOutput($outputMessagePsr1->getSuccessfulMessage());

        $outputMessagePsr2 = new PreCommitOutputWriter('Checking PSR2 code style with PHP-CS-FIXER');
        $this->shouldWriteOutput($outputMessagePsr2->getMessage());

        foreach ($phpFiles as $file) {
            $this->shouldProcessPhpCsFixerTool($file, '@PSR2', $phpCsFixerOptions->value(), null);
        }

        $this->shouldWriteLnOutput($outputMessagePsr2->getSuccessfulMessage());

        $outputMessageSymfony = new PreCommitOutputWriter('Checking Symfony code style with PHP-CS-FIXER');
        $this->shouldWriteOutput($outputMessageSymfony->getMessage());

        foreach ($phpFiles as $file) {
            $this->shouldProcessPhpCsFixerTool($file, '@Symfony', $phpCsFixerOptions->value(), null);
        }

        $this->shouldWriteLnOutput($outputMessageSymfony->getSuccessfulMessage());

        $this->phpCsFixerToolCommandHandler->handle(
            new PhpCsFixerTool(
                $phpFiles,
                $configurationData->getPreCommit()->getPhpCsFixer()->isPhpCsFixerPsr0(),
                $configurationData->getPreCommit()->getPhpCsFixer()->isPhpCsFixerPsr1(),
                $configurationData->getPreCommit()->getPhpCsFixer()->isPhpCsFixerPsr2(),
                $configurationData->getPreCommit()->getPhpCsFixer()->isPhpCsFixerSymfony(),
                $phpCsFixerOptions->value(),
                $configurationData->getPreCommit()->getErrorMessage(),
                $configurationData->getPreCommit()->isEnableFaces()
            )
        );
    }
}
