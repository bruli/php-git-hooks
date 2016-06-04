<?php

namespace Module\Git\Tests\Infrastructure;

use Module\Tests\Infrastructure\UnitTestCase\Mock;
use Symfony\Component\Console\Output\OutputInterface;

trait OutputInterfaceTrait
{
    /**
     * @var OutputInterface
     */
    private $outputInterface;

    /**
     * @return \Mockery\MockInterface|OutputInterface
     */
    protected function getOutputInterface()
    {
        return $this->outputInterface = $this->outputInterface ?: Mock::get(OutputInterface::class);
    }

    /**
     * @param string $message
     */
    protected function shouldWriteLnOutput($message)
    {
        $this->getOutputInterface()
            ->shouldReceive('writeln')
            ->once()
            ->with($message);
    }
}
