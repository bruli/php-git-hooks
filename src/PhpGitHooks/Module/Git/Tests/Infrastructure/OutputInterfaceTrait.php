<?php

namespace PhpGitHooks\Module\Git\Tests\Infrastructure;

use PhpGitHooks\Module\Tests\Infrastructure\UnitTestCase\Mock;
use Symfony\Component\Console\Output\OutputInterface;

trait OutputInterfaceTrait
{
    /**
     * @var OutputInterface
     */
    private $outputInterface;

    /**
     * @return object|OutputInterface
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
    /**
     * @param string $message
     */
    protected function shouldWriteOutput($message)
    {
        $this->getOutputInterface()
            ->shouldReceive('write')
            ->once()
            ->with($message);
    }
}
