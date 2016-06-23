<?php

namespace PhpGitHooks\Module\PhpMd\Tests\Infrastructure;

use PhpGitHooks\Module\PhpMd\Model\PhpMdToolProcessorInterface;
use PhpGitHooks\Module\Tests\Infrastructure\UnitTestCase\Mock;

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
     * @param string $options
     * @param string $return
     */
    protected function shouldProcessPhpMdTool($file, $options, $return)
    {
        $this->getPhpMdToolProcessor()
            ->shouldReceive('process')
            ->once()
            ->withArgs([$file, $options])
            ->andReturn($return);
    }
}
