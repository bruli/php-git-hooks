<?php

namespace Module\Configuration\Tests\Stub;

use Module\Configuration\Domain\Enabled;
use Module\Configuration\Domain\JsonLint;
use Module\Configuration\Domain\Undefined;
use Module\Tests\Infrastructure\Stub\RandomStubInterface;

class JsonLintStub implements RandomStubInterface
{
    /**
     * @param Undefined $undefined
     * @param Enabled   $enabled
     *
     * @return JsonLint
     */
    public static function create(Undefined $undefined, Enabled $enabled)
    {
        return new JsonLint($undefined, $enabled);
    }

    /**
     * @return JsonLint
     */
    public static function random()
    {
        return self::create(new Undefined(false), EnabledStub::random());
    }
}
