<?php

namespace PhpGitHooks\Module\Configuration\Service;

use PhpGitHooks\Module\Configuration\Domain\Enabled;
use PhpGitHooks\Module\Configuration\Domain\PhpLint;
use PhpGitHooks\Module\Configuration\Domain\Undefined;

class PhpLintFactory
{
    /**
     * @param $data
     *
     * @return PhpLint
     */
    public static function fromArray($data)
    {
        return new PhpLint(
            new Undefined(false),
            new Enabled($data)
        );
    }

    /**
     * @return PhpLint
     */
    public static function setUndefined()
    {
        return new PhpLint(
            new Undefined(true),
            new Enabled(false)
        );
    }
}
