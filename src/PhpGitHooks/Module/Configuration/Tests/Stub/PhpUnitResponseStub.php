<?php

namespace PhpGitHooks\Module\Configuration\Tests\Stub;

use PhpGitHooks\Module\Configuration\Contract\Response\PhpUnitResponse;

class PhpUnitResponseStub
{
    const OPTIONS = '--color';

    /**
     * @param bool        $phpunit
     * @param bool        $randomMode
     * @param string|null $options
     *
     * @return PhpUnitResponse
     */
    public static function create($phpunit, $randomMode, $options)
    {
        return new PhpUnitResponse($phpunit, $randomMode, $options);
    }

    /**
     * @return PhpUnitResponse
     */
    public static function createEnabled()
    {
        return self::create(true, true, self::OPTIONS);
    }
}
