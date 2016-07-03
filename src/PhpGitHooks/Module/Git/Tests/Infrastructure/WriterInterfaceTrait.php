<?php

namespace PhpGitHooks\Module\Git\Tests\Infrastructure;

use PhpGitHooks\Module\Git\Model\WriterInterface;
use PhpGitHooks\Module\Tests\Infrastructure\UnitTestCase\Mock;

trait WriterInterfaceTrait
{
    /**
     * @var WriterInterface
     */
    private $writer;

    /**
     * @return \Mockery\MockInterface|WriterInterface
     */
    protected function getWriter()
    {
        return $this->writer = $this->writer ?: Mock::get(WriterInterface::class);
    }

    /**
     * @param string $data
     */
    protected function shouldWriteData($data)
    {
        $this->getWriter()
            ->shouldReceive('write')
            ->once()
            ->with($data);
    }
}
