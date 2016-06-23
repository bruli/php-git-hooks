<?php

namespace PhpGitHooks\Module\Configuration\Service;

use PhpGitHooks\Module\Configuration\Domain\Enabled;
use PhpGitHooks\Module\Configuration\Domain\PhpUnit;
use PhpGitHooks\Module\Configuration\Domain\PhpUnitOptions;
use PhpGitHooks\Module\Configuration\Domain\PhpUnitRandomMode;
use PhpGitHooks\Module\Configuration\Domain\Undefined;

class PhpUnitFactory
{
    /**
     * @param array $data
     *
     * @return PhpUnit
     */
    public static function fromArray(array $data)
    {
        return new PhpUnit(
            new Undefined(false),
            new Enabled($data['enabled']),
            new PhpUnitRandomMode($data['random-mode']),
            new PhpUnitOptions($data['options'])
        );
    }

    /**
     * @return PhpUnit
     */
    public static function setUndefined()
    {
        return new PhpUnit(
            new Undefined(true),
            new Enabled(false),
            new PhpUnitRandomMode(false),
            new PhpUnitOptions(null)
        );
    }
}
