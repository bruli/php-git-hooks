<?php

namespace PhpGitHooks\Module\Configuration\Service;

use PhpGitHooks\Module\Configuration\Domain\Enabled;
use PhpGitHooks\Module\Configuration\Domain\Ignore;
use PhpGitHooks\Module\Configuration\Domain\PhpCs;
use PhpGitHooks\Module\Configuration\Domain\PhpCsStandard;
use PhpGitHooks\Module\Configuration\Domain\Undefined;

class PhpCsFactory
{
    /**
     * @param array $data
     *
     * @return PhpCs
     */
    public static function fromArray(array $data)
    {
        return new PhpCs(
            new Undefined(false),
            new Enabled($data['enabled']),
            new PhpCsStandard($data['standard']),
            new Ignore(isset($data['ignore']) ? $data['ignore'] : '')
        );
    }

    /**
     * @return PhpCs
     */
    public static function setUndefined()
    {
        return new PhpCs(
            new Undefined(true),
            new Enabled(false),
            new PhpCsStandard(null),
            new Ignore(null)
        );
    }
}
