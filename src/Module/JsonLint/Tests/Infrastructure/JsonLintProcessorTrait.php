<?php

namespace Module\JsonLint\Tests\Infrastructure;

use Module\JsonLint\Infrastructure\Tool\JsonLintProcessor;
use Module\JsonLint\Model\JsonLintProcessorInterface;
use Module\Tests\Infrastructure\UnitTestCase\Mock;

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
