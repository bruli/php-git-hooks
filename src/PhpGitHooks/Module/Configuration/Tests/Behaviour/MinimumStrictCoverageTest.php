<?php

namespace PhpGitHooks\Module\Configuration\Tests\Behaviour;

use PhpGitHooks\Module\Configuration\Domain\MinimumStrictCoverage;
use PHPUnit\Framework\TestCase;
use PhpValueObjects\Scalar\Exception\InvalidFloatException;

class MinimumStrictCoverageTest extends TestCase
{
    /**
     * @test
     */
    public function itShouldThrowsException()
    {
        $this->expectException(InvalidFloatException::class);

        new MinimumStrictCoverage('string');
    }
}
