<?php

namespace Module\JsonLint\Tests\Infrastructure;

use Module\JsonLint\Contract\Command\JsonLintToolCommand;
use Module\JsonLint\Contract\CommandHandler\JsonLintToolCommandHandler;
use Module\Tests\Infrastructure\UnitTestCase\Mock;
use Module\Tests\Infrastructure\UnitTestCase\SimilarTo;

trait JsonLintToolCommandHandlerTrait
{
    /**
     * @var JsonLintToolCommandHandler
     */
    private $jsonLintToolCommandHandler;
    /**
     * @return \Mockery\MockInterface|JsonLintToolCommandHandler
     */
    protected function getJsonLintToolCommandHandler()
    {
        return $this->jsonLintToolCommandHandler = $this->jsonLintToolCommandHandler ?: Mock::get(
            JsonLintToolCommandHandler::class
        );
    }

    /**
     * @param JsonLintToolCommand $jsonLintToolCommand
     */
    protected function shouldHandleJsonLintToolCommand(JsonLintToolCommand $jsonLintToolCommand)
    {
        $this->getJsonLintToolCommandHandler()
            ->shouldReceive('handle')
            ->once()
            ->with((new SimilarTo())->compare($jsonLintToolCommand));
    }
}
