<?php

namespace PhpGitHooks\Module\Configuration\Service;

use PhpGitHooks\Module\Configuration\Domain\Enabled;
use PhpGitHooks\Module\Configuration\Domain\PhpCsFixer;
use PhpGitHooks\Module\Configuration\Domain\PhpCsFixerOptions;
use PhpGitHooks\Module\Configuration\Domain\Undefined;

class PhpCsFixerFactory
{
    /**
     * @param array $data
     *
     * @return PhpCsFixer
     */
    public static function fromArray(array $data)
    {
        return new PhpCsFixer(
            new Undefined(false),
            new Enabled($data['enabled']),
            PhpCsFixerLevelsFactory::fromArray($data['levels']),
            new PhpCsFixerOptions(isset($data['options']) ? $data['options'] : null)
        );
    }

    /**
     * @return PhpCsFixer
     */
    public static function setUndefined()
    {
        return new PhpCsFixer(
            new Undefined(true),
            new Enabled(false),
            PhpCsFixerLevelsFactory::setUndefined(),
            new PhpCsFixerOptions(null)
        );
    }
}
