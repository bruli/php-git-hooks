<?php

namespace PhpGitHooks\Module\Configuration\Tests\Behaviour;

use PhpGitHooks\Module\Configuration\Domain\Level;
use PHPUnit\Framework\TestCase;
use PhpValueObjects\Scalar\Exception\InvalidBooleanException;

class LevelTest extends TestCase
{
    /**
     * @test
     */
    public function itShouldThrowsException()
    {
        $this->expectException(InvalidBooleanException::class);

        new Level('string');
    }
}
