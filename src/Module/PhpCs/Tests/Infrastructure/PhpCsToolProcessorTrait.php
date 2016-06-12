<?php

namespace Module\PhpCs\Tests\Infrastructure;

use Module\PhpCs\Infrastructure\Tool\PhpCsToolProcessor;
use Module\PhpCs\Model\PhpCsToolProcessorInterface;
use Module\Tests\Infrastructure\UnitTestCase\Mock;

trait PhpCsToolProcessorTrait
{
    /**
     * @var PhpCsToolProcessor
     */
    private $phpCsToolProcessor;

    /**
     * @return \Mockery\MockInterface|PhpCsToolProcessorInterface
     */
    protected function getPhpCsToolProcessor()
    {
        return $this->phpCsToolProcessor = $this->phpCsToolProcessor ?: Mock::get(PhpCsToolProcessorInterface::class);
    }

    /**
     * @param string $file
     * @param string $standard
     * @param string $return
     */
    protected function shouldProcessPhpCsTool($file, $standard, $return)
    {
        $this->getPhpCsToolProcessor()
            ->shouldReceive('process')
            ->once()
            ->withArgs([$file, $standard])
            ->andReturn($return);
    }
}
