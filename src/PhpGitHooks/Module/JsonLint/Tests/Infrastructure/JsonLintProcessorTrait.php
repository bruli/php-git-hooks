<?php

namespace PhpGitHooks\Module\JsonLint\Tests\Infrastructure;

use PhpGitHooks\Module\JsonLint\Infrastructure\Tool\JsonLintProcessor;
use PhpGitHooks\Module\JsonLint\Model\JsonLintProcessorInterface;
use PhpGitHooks\Module\Tests\Infrastructure\UnitTestCase\Mock;

trait JsonLintProcessorTrait
{
    /**
     * @var JsonLintProcessorInterface
     */
    private $jsonLintProcessor;

    /**
     * @return \Mockery\MockInterface|JsonLintProcessorInterface
     */
    protected function getJsonLintProcessor()
    {
        return $this->jsonLintProcessor = $this->jsonLintProcessor ?: Mock::get(JsonLintProcessorInterface::class);
    }

    /**
     * @param string      $file
     * @param string|null $returnError
     */
    protected function shouldProcessJsonLint($file, $returnError)
    {
        $this->getJsonLintProcessor()
            ->shouldReceive('process')
            ->once()
            ->with($file)
            ->andReturn($returnError);
    }
}
