<?php

namespace PhpGitHooks\Module\Configuration\Tests\Stub;

use PhpGitHooks\Module\Configuration\Domain\Enabled;
use PhpGitHooks\Module\Tests\Infrastructure\Stub\RandomStubInterface;
use PhpGitHooks\Module\Tests\Infrastructure\Stub\StubCreator;

class EnabledStub implements RandomStubInterface
{
    /**
     * @param bool $value
     *
     * @return Enabled
     */
    public static function create($value)
    {
        return new Enabled($value);
    }

    /**
     * @return Enabled
     */
    public static function random()
    {
        return self::create(StubCreator::faker()->boolean);
    }
}
