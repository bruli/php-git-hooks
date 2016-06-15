<?php

namespace PhpGitHooks\Module\PhpLint\Tests\Infrastructure;

use PhpGitHooks\Module\PhpLint\Model\PhpLintToolProcessorInterface;
use PhpGitHooks\Module\Tests\Infrastructure\UnitTestCase\Mock;

trait PhpLintToolProcessorTrait
{
    /**
     * @var PhpLintToolProcessorInterface
     */
    private $phpLintToolProcessor;

    /**
     * @return \Mockery\MockInterface|PhpLintToolProcessorInterface
     */
    protected function getPhpLintToolProcessor()
    {
        return $this->phpLintToolProcessor = $this->phpLintToolProcessor ?: Mock::get(
            PhpLintToolProcessorInterface::class
        );
    }

    /**
     * @param string      $file
     * @param string|null $error
     */
    protected function shouldProcessPhpLintTool($file, $error)
    {
        $this->getPhpLintToolProcessor()
            ->shouldReceive('process')
            ->once()
            ->with($file)
            ->andReturn($error);
    }
}
