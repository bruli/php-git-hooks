<?php

namespace PhpGitHooks\Module\Configuration\Tests\Stub;

use PhpGitHooks\Module\Configuration\Domain\Execute;
use PhpGitHooks\Module\Configuration\Domain\PhpUnit;

class PrePushExecuteStub
{
    /**
     * @param PhpUnit $phpUnit
     *
     * @return Execute
     */
    public static function create(PhpUnit $phpUnit)
    {
        return new Execute([$phpUnit]);
    }

    /**
     * @return Execute
     */
    public static function createEnabled()
    {
        return self::create(PhpUnitStub::createEnabled());
    }
}
