<?php

namespace PhpGitHooks\Module\Configuration\Service;

use PhpGitHooks\Module\Configuration\Domain\Enabled;
use PhpGitHooks\Module\Configuration\Domain\Message;
use PhpGitHooks\Module\Configuration\Domain\PhpUnitGuardCoverage;
use PhpGitHooks\Module\Configuration\Domain\Undefined;

class PhpUnitGuardCoverageFactory
{
    /**
     * @param array $data
     *
     * @return PhpUnitGuardCoverage
     */
    public static function build(array $data)
    {
        return new PhpUnitGuardCoverage(
            new Undefined(false),
            new Enabled($data['enabled']),
            new Message($data['message'])
        );
    }

    /**
     * @return PhpUnitGuardCoverage
     */
    public static function setUndefined()
    {
        return new PhpUnitGuardCoverage(
            new Undefined(true),
            new Enabled(false),
            new Message(null)
        );
    }
}
