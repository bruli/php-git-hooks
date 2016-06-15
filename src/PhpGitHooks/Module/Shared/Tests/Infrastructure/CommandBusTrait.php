<?php

namespace PhpGitHooks\Module\Shared\Tests\Infrastructure;

use PhpGitHooks\Infrastructure\CommandBus\CommandBus;
use PhpGitHooks\Infrastructure\CommandBus\CommandInterface;
use PhpGitHooks\Module\Tests\Infrastructure\UnitTestCase\Mock;
use PhpGitHooks\Module\Tests\Infrastructure\UnitTestCase\SimilarTo;

trait CommandBusTrait
{
    /**
     * @var CommandBus
     */
    private $commandBus;

    /**
     * @return \Mockery\MockInterface|CommandBus
     */
    protected function getCommandBus()
    {
        return $this->commandBus = $this->commandBus ?: Mock::get(CommandBus::class);
    }

    /**
     * @param CommandInterface $command
     */
    protected function shouldHandleCommand(CommandInterface $command)
    {
        $this->getCommandBus()
            ->shouldReceive('handle')
            ->once()
            ->with((new SimilarTo())->compare($command));
    }
}
