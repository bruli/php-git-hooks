<?php

namespace PhpGitHooks\Module\Configuration\Tests\Stub;

use PhpGitHooks\Module\Configuration\Domain\PhpUnitRandomMode;
use PhpGitHooks\Module\Tests\Infrastructure\Stub\RandomStubInterface;
use PhpGitHooks\Module\Tests\Infrastructure\Stub\StubCreator;

class PhpUnitRandomModeStub implements RandomStubInterface
{
    /**
     * @param bool $value
     *
     * @return PhpUnitRandomMode
     */
    public static function create($value)
    {
        return new PhpUnitRandomMode($value);
    }

    /**
     * @return PhpUnitRandomMode
     */
    public static function random()
    {
        return self::create(StubCreator::faker()->boolean);
    }
}
