<?php

namespace PhpGitHooks\Module\Configuration\Tests\Infrastructure;

use Composer\IO\IOInterface;
use PhpGitHooks\Module\Tests\Infrastructure\UnitTestCase\Mock;

trait IoInterfaceTrait
{
    /**
     * @var IOInterface
     */
    private $ioInterface;
    /**
     * @return \Mockery\MockInterface|IOInterface
     */
    protected function getIOInterface()
    {
        return $this->ioInterface = $this->ioInterface ?: Mock::get(IOInterface::class);
    }

    /**
     * @param string $question
     * @param string $default
     * @param string $return
     */
    protected function shouldAsk($question, $default, $return)
    {
        $this->getIOInterface()
             ->shouldReceive('ask')
             ->once()
             ->withArgs([$question, $default])
             ->andReturn($return)
        ;
    }
}
