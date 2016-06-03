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
     * @param array $return
     */
    protected function shouldGetFilesCommitted(array $return)
    {
        $this->getFilesCommittedExtractor()
             ->shouldReceive('getFiles')
             ->once()
             ->andReturn($return);
    }
}
