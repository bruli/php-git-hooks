<?php

namespace Module\Configuration\Service;

use Module\Configuration\Domain\Enabled;
use Module\Configuration\Domain\PhpMd;
use Module\Configuration\Domain\Undefined;

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
            new Enabled($data)
        );
    }

    /**
     * @return PhpMd
     */
    public static function setUndefined()
    {
        return new PhpMd(
            new Undefined(true),
            new Enabled(false)
        );
    }
}
