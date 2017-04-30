<?php

namespace PhpGitHooks\Module\Configuration\Tests\Behaviour;

use PhpGitHooks\Module\Configuration\Contract\Exception\InvalidPhpCsStandardException;
use PhpGitHooks\Module\Configuration\Domain\PhpCsStandard;
use PHPUnit\Framework\TestCase;

class PhpCsStandardTest extends TestCase
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
