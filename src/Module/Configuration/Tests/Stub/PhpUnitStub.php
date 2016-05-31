<?php

namespace Module\Configuration\Tests\Stub;

use Module\Configuration\Domain\Enabled;
use Module\Configuration\Domain\PhpUnit;
use Module\Configuration\Domain\PhpUnitOptions;
use Module\Configuration\Domain\PhpUnitRandomMode;
use Module\Configuration\Domain\Undefined;
use Module\Tests\Infrastructure\Stub\RandomStubInterface;

class PhpUnitStub implements RandomStubInterface
{
    /**
     * @param Undefined         $undefined
     * @param Enabled           $enabled
     * @param PhpUnitRandomMode $randomMode
     * @param PhpUnitOptions    $options
     *
     * @return PhpUnit
     */
    public static function create(
        Undefined $undefined,
        Enabled $enabled,
        PhpUnitRandomMode $randomMode,
        PhpUnitOptions $options
    ) {
        return new PhpUnit($undefined, $enabled, $randomMode, $options);
    }

    /**
     * @return PhpUnit
     */
    public static function random()
    {
        return self::create(
            new Undefined(false),
            EnabledStub::random(),
            PhpUnitRandomModeStub::random(),
            PhpUnitOptionsStub::random()
        );
    }
}
