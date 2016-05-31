<?php

namespace Module\Configuration\Service;

use Module\Configuration\Domain\Enabled;
use Module\Configuration\Domain\PhpCsFixer;
use Module\Configuration\Domain\Undefined;

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
            PhpCsFixerLevelsFactory::fromArray($data['levels'])
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
            PhpCsFixerLevelsFactory::setUndefined()
        );
    }
}
