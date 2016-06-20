<?php

namespace PhpGitHooks\Module\Configuration\Tests\Stub;

use PhpGitHooks\Module\Configuration\Domain\Composer;
use PhpGitHooks\Module\Configuration\Domain\Enabled;
use PhpGitHooks\Module\Configuration\Domain\Undefined;
use PhpGitHooks\Module\Tests\Infrastructure\Stub\RandomStubInterface;

class ComposerStub implements RandomStubInterface
{
    /**
     * @param Undefined $undefined
     * @param Enabled   $enabled
     *
     * @return Composer
     */
    public static function create(Undefined $undefined, Enabled $enabled)
    {
        return new Composer($undefined, $enabled);
    }

    /**
     * @return Composer
     */
    public static function random()
    {
        return self::create(new Undefined(false), EnabledStub::random());
    }

    /**
     * @return Composer
     */
    public static function createEnabled()
    {
        return self::create(new Undefined(false), EnabledStub::create(true));
    }
}
