<?php

namespace PhpGitHooks\Module\Configuration\Tests\Stub;

use PhpGitHooks\Module\Configuration\Domain\Level;
use PhpGitHooks\Module\Tests\Infrastructure\Stub\RandomStubInterface;
use PhpGitHooks\Module\Tests\Infrastructure\Stub\StubCreator;

class LevelStub implements RandomStubInterface
{
    /**
     * @param bool $value
     *
     * @return Level
     */
    public static function create($value)
    {
        return new Level($value);
    }

    /**
     * @return Level
     */
    public static function random()
    {
        return self::create(StubCreator::faker()->boolean);
    }
}
