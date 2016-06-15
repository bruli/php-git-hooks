<?php

namespace PhpGitHooks\Module\Configuration\Service;

use PhpGitHooks\Module\Configuration\Domain\Composer;
use PhpGitHooks\Module\Configuration\Domain\Enabled;
use PhpGitHooks\Module\Configuration\Domain\Undefined;

class ComposerFactory
{
    /**
     * @param bool $data
     *
     * @return Composer
     */
    public static function fromArray($data)
    {
        return new Composer(
            new Undefined(false),
            new Enabled($data)
        );
    }

    /**
     * @return Composer
     */
    public static function setUndefined()
    {
        return new Composer(
            new Undefined(true),
            new Enabled(false)
        );
    }
}
