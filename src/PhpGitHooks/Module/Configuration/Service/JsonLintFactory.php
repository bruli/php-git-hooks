<?php

namespace PhpGitHooks\Module\Configuration\Service;

use PhpGitHooks\Module\Configuration\Domain\Enabled;
use PhpGitHooks\Module\Configuration\Domain\JsonLint;
use PhpGitHooks\Module\Configuration\Domain\Undefined;

class JsonLintFactory
{
    /**
     * @param bool $data
     *
     * @return JsonLint
     */
    public static function fromArray($data)
    {
        return new JsonLint(
            new Undefined(false),
            new Enabled($data)
        );
    }

    /**
     * @return JsonLint
     */
    public static function setUndefined()
    {
        return new JsonLint(
            new Undefined(true),
            new Enabled(false)
        );
    }
}
