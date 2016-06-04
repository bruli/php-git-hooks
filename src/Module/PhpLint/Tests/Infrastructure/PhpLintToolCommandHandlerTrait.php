<?php

namespace Module\PhpLint\Tests\Infrastructure;

use Module\PhpLint\Contract\Command\PhpLintToolCommand;
use Module\PhpLint\Contract\CommandHandler\PhpLintToolCommandHandler;
use Module\Tests\Infrastructure\UnitTestCase\Mock;
use Module\Tests\Infrastructure\UnitTestCase\SimilarTo;

trait PhpLintToolCommandHandlerTrait
{
    /**
     * @var PhpLintToolCommandHandler
     */
    private $phpLintToolCommandHandler;

    /**
     * @return \Mockery\MockInterface|PhpLintToolCommandHandler
     */
    protected function getPhpLintToolCommandHandler()
    {
        return $this->phpLintToolCommandHandler = $this->phpLintToolCommandHandler ?: Mock::get(
            PhpLintToolCommandHandler::class
        );
    }

    /**
     * @param PhpLintToolCommand $phpLintToolCommand
     */
    protected function shouldHandlePhpLintToolCommand(PhpLintToolCommand $phpLintToolCommand)
    {
        $this->getPhpLintToolCommandHandler()
            ->shouldReceive('handle')
            ->once()
            ->with((new SimilarTo())->compare($phpLintToolCommand));
    }
}
