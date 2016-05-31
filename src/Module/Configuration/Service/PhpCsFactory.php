<?php

namespace Module\Configuration\Service;

use Module\Configuration\Domain\Enabled;
use Module\Configuration\Domain\PhpCs;
use Module\Configuration\Domain\PhpCsStandard;
use Module\Configuration\Domain\Undefined;

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
            new PhpCsStandard($data['standard'])
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
            new PhpCsStandard(null)
        );
    }
}
