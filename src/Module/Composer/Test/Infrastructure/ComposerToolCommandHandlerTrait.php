<?php

namespace Module\Composer\Test\Infrastructure;

use Module\Composer\Contract\Command\ComposerToolCommand;
use Module\Composer\Contract\CommandHandler\ComposerToolCommandHandler;
use Module\Tests\Infrastructure\UnitTestCase\Mock;
use Module\Tests\Infrastructure\UnitTestCase\SimilarTo;

trait ComposerToolCommandHandlerTrait
{
    /**
     * @var ComposerToolCommandHandler
     */
    private $composerToolCommandHandler;

    /**
     * @return \Mockery\MockInterface|ComposerToolCommandHandler
     */
    protected function getComposerToolCommandHandler()
    {
        return $this->composerToolCommandHandler = $this->composerToolCommandHandler ?: Mock::get(
            ComposerToolCommandHandler::class
        );
    }

    /**
     * @param ComposerToolCommand $composerToolCommand
     */
    protected function shouldHandleComposerToolCommand(ComposerToolCommand $composerToolCommand)
    {
        $this->getComposerToolCommandHandler()
            ->shouldReceive('handle')
            ->once()
            ->with((new SimilarTo())->compare($composerToolCommand));
    }
}
