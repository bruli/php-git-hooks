<?php

namespace Module\Configuration\Service;

use Module\Configuration\Domain\Enabled;
use Module\Configuration\Domain\JsonLint;
use Module\Configuration\Domain\Undefined;

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
