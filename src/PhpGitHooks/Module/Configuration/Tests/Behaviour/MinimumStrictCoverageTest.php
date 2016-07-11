<?php

namespace PhpGitHooks\Module\Configuration\Tests\Behaviour;

use PhpGitHooks\Module\Configuration\Domain\MinimumStrictCoverage;
use PhpValueObjects\Scalar\Exception\InvalidFloatException;

class MinimumStrictCoverageTest extends \PHPUnit_Framework_TestCase
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
