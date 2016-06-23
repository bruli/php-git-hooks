<?php

namespace PhpGitHooks\Module\Configuration\Tests\Behaviour;

use PhpGitHooks\Module\Configuration\Domain\Level;
use PhpGitHooks\Module\Shared\Contract\Exception\InvalidBooleanException;

class LevelTest extends \PHPUnit_Framework_TestCase
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
