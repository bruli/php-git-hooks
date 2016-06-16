<?php

namespace PhpGitHooks\Module\Configuration\Tests\Behaviour;

use PhpGitHooks\Module\Configuration\Contract\Exception\InvalidToolInterfaceException;

class InvalidToolInterfaceExceptionTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function itShouldReturnMessage()
    {
        try {
            throw new InvalidToolInterfaceException('tool_name');
        } catch (InvalidToolInterfaceException $e) {
            $this->assertTrue(is_string($e->getMessage()));
        }
    }
}
