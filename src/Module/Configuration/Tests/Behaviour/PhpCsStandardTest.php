<?php

namespace Module\Configuration\Tests\Behaviour;

use Module\Configuration\Contract\Exception\InvalidPhpCsStandardException;
use Module\Configuration\Domain\PhpCsStandard;

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
