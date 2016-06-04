<?php

namespace Module\PhpCsFixer\Tests\Infrastructure;

use Module\PhpCsFixer\Contract\Command\PhpCsFixerToolCommand;
use Module\PhpCsFixer\Contract\CommandHandler\PhpCsFixerToolCommandHandler;
use Module\Tests\Infrastructure\UnitTestCase\Mock;
use Module\Tests\Infrastructure\UnitTestCase\SimilarTo;

trait PhpCsFixerToolCommandHandlerTrait
{
    /**
     * @var PhpCsFixerToolCommandHandler
     */
    private $phpCsFixerToolCommandHandler;

    /**
     * @return \Mockery\MockInterface|PhpCsFixerToolCommandHandler
     */
    protected function getPhpCsFixerToolCommandHandler()
    {
        return $this->phpCsFixerToolCommandHandler = $this->phpCsFixerToolCommandHandler ?: Mock::get(
            PhpCsFixerToolCommandHandler::class
        );
    }

    /**
     * @param PhpCsFixerToolCommand $phpCsFixerToolCommand
     */
    protected function shouldHandlePhpCsFixerToolCommand(PhpCsFixerToolCommand $phpCsFixerToolCommand)
    {
        $this->getPhpCsFixerToolCommandHandler()
            ->shouldReceive('handle')
            ->once()
            ->with((new SimilarTo())->compare($phpCsFixerToolCommand));
    }
}
