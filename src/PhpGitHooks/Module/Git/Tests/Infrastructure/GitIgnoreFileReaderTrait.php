<?php

namespace PhpGitHooks\Module\Git\Tests\Infrastructure;

use PhpGitHooks\Module\Git\Model\ReaderInterface;
use PhpGitHooks\Module\Tests\Infrastructure\UnitTestCase\Mock;

trait GitIgnoreFileReaderTrait
{
    /**
     * @var ReaderInterface
     */
    private $gitIgnoreFileReader;

    /**
     * @return \Mockery\MockInterface|ReaderInterface
     */
    protected function getGitIgnoreFileReader()
    {
        return $this->gitIgnoreFileReader = $this->gitIgnoreFileReader ?: Mock::get(ReaderInterface::class);
    }

    /**
     * @param string|null $return
     */
    protected function shouldReadGitIgnoreFile($return)
    {
        $this->getGitIgnoreFileReader()
            ->shouldReceive('read')
            ->once()
            ->andReturn($return);
    }
}
