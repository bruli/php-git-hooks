<?php

namespace PhpGitHooks\Module\Configuration\Service;

use PhpGitHooks\Module\Configuration\Domain\Enabled;
use PhpGitHooks\Module\Configuration\Domain\PhpMd;
use PhpGitHooks\Module\Configuration\Domain\PhpMdOptions;
use PhpGitHooks\Module\Configuration\Domain\Undefined;

class PhpMdFactory
{
    /**
     * @param $data
     *
     * @return PhpMd
     */
    public static function fromArray($data)
    {
        return new PhpMd(
            new Undefined(false),
            new Enabled($data['enabled']),
            new PhpMdOptions($data['options'])
        );
    }

    /**
     * @return PhpMd
     */
    public static function setUndefined()
    {
        return new PhpMd(
            new Undefined(true),
            new Enabled(false),
            new PhpMdOptions(null)
        );
    }
}
