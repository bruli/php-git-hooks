<?php

namespace Module\PhpMd\Tests\Infrastructure;

use Module\PhpMd\Model\PhpMdToolProcessorInterface;
use Module\Tests\Infrastructure\UnitTestCase\Mock;

trait PhpMdToolProcessorTrait
{
    /**
     * @var PhpMdToolProcessorInterface
     */
    private $phpMdToolProcessor;

    /**
     * @return \Mockery\MockInterface|PhpMdToolProcessorInterface
     */
    protected function getPhpMdToolProcessor()
    {
        return $this->phpMdToolProcessor = $this->phpMdToolProcessor ?: Mock::get(PhpMdToolProcessorInterface::class);
    }

    /**
     * @param string $file
     * @param string $return
     */
    protected function shouldProcessPhpMdTool($file, $return)
    {
        $this->getPhpMdToolProcessor()
            ->shouldReceive('process')
            ->once()
            ->with($file)
            ->andReturn($return);
    }
}
