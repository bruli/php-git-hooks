<?php

namespace Module\Configuration\Service;

use Module\Configuration\Domain\Enabled;
use Module\Configuration\Domain\PhpUnit;
use Module\Configuration\Domain\PhpUnitOptions;
use Module\Configuration\Domain\PhpUnitRandomMode;
use Module\Configuration\Domain\Undefined;

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
