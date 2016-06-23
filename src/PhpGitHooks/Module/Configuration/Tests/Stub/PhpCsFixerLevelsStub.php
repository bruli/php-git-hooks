<?php

namespace PhpGitHooks\Module\Configuration\Tests\Stub;

use PhpGitHooks\Module\Configuration\Domain\Level;
use PhpGitHooks\Module\Configuration\Domain\PhpCsFixerLevels;
use PhpGitHooks\Module\Tests\Infrastructure\Stub\RandomStubInterface;

class PhpCsFixerLevelsStub implements RandomStubInterface
{
    /**
     * @param Level $psr0
     * @param Level $psr1
     * @param Level $psr2
     * @param Level $symfony
     *
     * @return PhpCsFixerLevels
     */
    public static function create(Level $psr0, Level $psr1, Level $psr2, Level $symfony)
    {
        return new PhpCsFixerLevels($psr0, $psr1, $psr2, $symfony);
    }

    /**
     * @return PhpCsFixerLevels
     */
    public static function random()
    {
        return self::create(LevelStub::random(), LevelStub::random(), LevelStub::random(), LevelStub::random());
    }

    /**
     * @return PhpCsFixerLevels
     */
    public static function createEnabled()
    {
        return self::create(
            LevelStub::create(true),
            LevelStub::create(true),
            LevelStub::create(true),
            LevelStub::create(true)
        );
    }
}
