<?php

namespace PhpGitHooks\Module\PhpUnit\Tests\Infrastructure;

use PhpGitHooks\Module\PhpUnit\Model\PhpUnitProcessorInterface;
use PhpGitHooks\Module\Tests\Infrastructure\UnitTestCase\Mock;

trait PhpUnitProcessorTrait
{
    /**
     * @var PhpUnitProcessorInterface
     */
    private $phpUnitProcessor;

    /**
     * @return \Mockery\MockInterface|PhpUnitProcessorInterface
     */
    protected function getPhpUnitProcessor()
    {
        return $this->phpUnitProcessor = $this->phpUnitProcessor ?: Mock::get(PhpUnitProcessorInterface::class);
    }

    /**
     * @param string $options
     * @param bool   $return
     */
    protected function shouldProcessPhpUnit($options, $return)
    {
        $this->getPhpUnitProcessor()
            ->shouldReceive('process')
            ->once()
            ->withArgs([$options])
            ->andReturn($return);
    }
}
