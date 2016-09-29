<?php

namespace PhpGitHooks\Module\PhpCsFixer\Tests\Infrastructure;

use Mockery\MockInterface;
use PhpGitHooks\Module\PhpCsFixer\Infrastructure\Tool\PhpCsFixerToolProcessor;
use PhpGitHooks\Module\PhpCsFixer\Model\PhpCsFixerToolProcessorInterface;
use PhpGitHooks\Module\Tests\Infrastructure\UnitTestCase\Mock;

trait PhpCsFixerToolProcessorTrait
{
    /**
     * @var PhpCsFixerToolProcessor
     */
    private $phpCsFixerToolProcessor;

    /**
     * @return MockInterface|PhpCsFixerToolProcessor
     */
    protected function getPhpCsFixerToolProcessor()
    {
        return $this->phpCsFixerToolProcessor = $this->phpCsFixerToolProcessor ?: Mock::get(
            PhpCsFixerToolProcessorInterface::class
        );
    }

    /**
     * @param string $file
     * @param string $level
     * @param string $options
     * @param string $return
     */
    protected function shouldProcessPhpCsFixerTool($file, $level, $options, $return)
    {
        $this->getPhpCsFixerToolProcessor()
            ->shouldReceive('process')
            ->once()
            ->withArgs([$file, $level, $options])
            ->andReturn($return);
    }
}
