<?php

namespace Module\PhpCs\Tests\Infrastructure;

use Module\PhpCs\Contract\Command\PhpCsToolCommand;
use Module\PhpCs\Contract\CommandHandler\PhpCsToolCommandHandler;
use Module\Tests\Infrastructure\UnitTestCase\Mock;
use Module\Tests\Infrastructure\UnitTestCase\SimilarTo;

trait PhpCSToolCommandHandlerTrait
{
    /**
     * @var PhpCsToolCommandHandler
     */
    private $phpCsToolCommandHandler;
    /**
     * @return \Mockery\MockInterface|PhpCsToolCommandHandler
     */
    protected function getPhpCsToolCommandHandler()
    {
        return $this->phpCsToolCommandHandler = $this->phpCsToolCommandHandler ?: Mock::get(
            PhpCsToolCommandHandler::class
        );
    }

    /**
     * @param PhpCsToolCommand $phpCsToolCommand
     */
    protected function shouldHandlePhpCsToolCommand(PhpCsToolCommand $phpCsToolCommand)
    {
        $this->getPhpCsToolCommandHandler()
            ->shouldReceive('handle')
            ->once()
            ->with((new SimilarTo())->compare($phpCsToolCommand));
    }
}
