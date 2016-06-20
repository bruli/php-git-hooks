<?php

namespace PhpGitHooks\Module\Configuration\Tests\Stub;

use PhpGitHooks\Module\Configuration\Domain\Enabled;
use PhpGitHooks\Module\Configuration\Domain\PhpMd;
use PhpGitHooks\Module\Configuration\Domain\Undefined;
use PhpGitHooks\Module\Tests\Infrastructure\Stub\RandomStubInterface;

class PhpMdStub implements RandomStubInterface
{
    /**
     * @param Undefined $undefined
     * @param Enabled   $enabled
     *
     * @return PhpMd
     */
    public static function create(Undefined $undefined, Enabled $enabled)
    {
        return new PhpMd($undefined, $enabled);
    }

    /**
     * @return PhpMd
     */
    public static function random()
    {
        return self::create(new Undefined(false), EnabledStub::random());
    }
    
    /**
     * @return PhpMd
     */
    public static function createEnabled()
    {
        return self::create(new Undefined(false), EnabledStub::create(true));
    }
}
