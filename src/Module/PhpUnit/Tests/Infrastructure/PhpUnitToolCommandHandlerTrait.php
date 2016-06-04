<?php

namespace Module\PhpUnit\Tests\Infrastructure;

use Module\PhpCsFixer\Contract\CommandHandler\PhpCsFixerToolCommandHandler;
use Module\PhpUnit\Contract\Command\PhpUnitToolCommand;
use Module\PhpUnit\Contract\CommandHandler\PhpUnitToolCommandHandler;
use Module\Tests\Infrastructure\UnitTestCase\Mock;
use Module\Tests\Infrastructure\UnitTestCase\SimilarTo;

trait PhpUnitToolCommandHandlerTrait
{
    /**
     * @var PhpUnitToolCommandHandler
     */
    private $phpUnitToolCommandHandler;

    /**
     * @return \Mockery\MockInterface|PhpCsFixerToolCommandHandler
     */
    protected function getPhpUnitToolCommandHandler()
    {
        return $this->phpUnitToolCommandHandler = $this->phpUnitToolCommandHandler ?: Mock::get(
            PhpUnitToolCommandHandler::class
        );
    }

    /**
     * @param PhpUnitToolCommand $phpUnitToolCommand
     */
    protected function shouldHandlePhpUnitToolCommand(PhpUnitToolCommand $phpUnitToolCommand)
    {
        $this->getPhpUnitToolCommandHandler()
            ->shouldReceive('handle')
            ->once()
            ->with((new SimilarTo())->compare($phpUnitToolCommand));
    }
}
