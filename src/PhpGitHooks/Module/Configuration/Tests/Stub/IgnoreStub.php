<?php

namespace PhpGitHooks\Module\Configuration\Tests\Stub;

use PhpGitHooks\Module\Configuration\Domain\Ignore;
use PhpGitHooks\Module\Tests\Infrastructure\Stub\RandomStubInterface;
use PhpGitHooks\Module\Tests\Infrastructure\Stub\StubCreator;

class IgnoreStub implements RandomStubInterface
{
    /**
     * @param string $value
     *
     * @return Ignore
     */
    public static function create($value)
    {
        return new Ignore($value);
    }

    /**
     * @return Ignore
     */
    public static function random()
    {
        return self::create(StubCreator::faker()->word);
    }
}
