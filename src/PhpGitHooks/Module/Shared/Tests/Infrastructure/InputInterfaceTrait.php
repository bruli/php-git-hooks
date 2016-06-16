<?php

namespace PhpGitHooks\Module\Shared\Tests\Infrastructure;

use PhpGitHooks\Module\Tests\Infrastructure\UnitTestCase\Mock;
use Symfony\Component\Console\Input\Input;
use Symfony\Component\Console\Input\InputInterface;

trait InputInterfaceTrait
{
    /**
     * @var InputInterface
     */
    private $input;

    /**
     * @return \Mockery\MockInterface|InputInterface
     */
    protected function getInput()
    {
        return $this->input = $this->input ?: Mock::get(InputInterface::class);
    }

    /**
     * @param string $return
     */
    protected function shouldGetInputFirstArgument($return)
    {
        $this->getInput()
            ->shouldReceive('getFirstArgument')
            ->once()
            ->andReturn($return);
    }
}
