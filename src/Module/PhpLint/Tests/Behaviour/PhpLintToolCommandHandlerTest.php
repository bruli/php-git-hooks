<?php

namespace Module\PhpLint\Tests\Behaviour;

use Module\Configuration\Tests\Stub\ConfigurationDataResponseStub;
use Module\Git\Tests\Stub\FilesCommittedStub;
use Module\PhpLint\Contract\Command\PhpLintToolCommand;
use Module\PhpLint\Contract\CommandHandler\PhpLintToolCommandHandler;
use Module\PhpLint\Service\PhpLintTool;
use Module\PhpLint\Service\PhpLintToolExecutor;
use Module\PhpLint\Tests\Infrastructure\PhpLintUnitTestCase;

class PhpLintToolCommandHandlerTest extends PhpLintUnitTestCase
{
    /**
     * @var PhpLintToolCommandHandler
     */
    private $phpLintToolCommandHandler;

    protected function setUp()
    {
        $this->phpLintToolCommandHandler = new PhpLintToolCommandHandler(
            new PhpLintTool(new PhpLintToolExecutor($this->getPhpLintToolProcessor(), $this->getOutputInterface()))
        );
    }

    /**
     * @test
     */
    public function itShouldNotExecuteTool()
    {
        $files = FilesCommittedStub::createWithoutPhpFiles();
        $this->phpLintToolCommandHandler->handle(
            new PhpLintToolCommand($files, ConfigurationDataResponseStub::FIX_YOUR_CODE)
        );
    }
}
