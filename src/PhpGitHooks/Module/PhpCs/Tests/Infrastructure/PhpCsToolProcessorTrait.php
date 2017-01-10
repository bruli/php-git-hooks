<?php

namespace PhpGitHooks\Module\PhpCs\Tests\Infrastructure;

use PhpGitHooks\Module\PhpCs\Infrastructure\Tool\PhpCsToolProcessor;
use PhpGitHooks\Module\PhpCs\Model\PhpCsToolProcessorInterface;
use PhpGitHooks\Module\Tests\Infrastructure\UnitTestCase\Mock;

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
     * @param string $ignore
     * @param string $return
     */
    protected function shouldProcessPhpCsTool($file, $standard, $ignore, $return)
    {
        $this->getPhpCsToolProcessor()
            ->shouldReceive('process')
            ->once()
            ->withArgs([$file, $standard, $ignore])
            ->andReturn($return);
    }
}
