<?php

namespace Module\Shared\Tests\Infrastructure;

use Infrastructure\CommandBus\CommandBus;
use Infrastructure\CommandBus\CommandInterface;
use Module\Tests\Infrastructure\UnitTestCase\Mock;
use Module\Tests\Infrastructure\UnitTestCase\SimilarTo;

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
