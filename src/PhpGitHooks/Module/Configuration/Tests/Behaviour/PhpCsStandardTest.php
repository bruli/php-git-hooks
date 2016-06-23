<?php

namespace PhpGitHooks\Module\Configuration\Tests\Behaviour;

use PhpGitHooks\Module\Configuration\Contract\Exception\InvalidPhpCsStandardException;
use PhpGitHooks\Module\Configuration\Domain\PhpCsStandard;

class PhpCsStandardTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function itShouldThrowException()
    {
        $this->expectException(InvalidPhpCsStandardException::class);
        new PhpCsStandard('invalid_data');
    }
}
