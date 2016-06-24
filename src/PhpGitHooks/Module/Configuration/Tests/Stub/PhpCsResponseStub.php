<?php

namespace PhpGitHooks\Module\Configuration\Tests\Stub;

use PhpGitHooks\Module\Configuration\Contract\Response\PhpCsResponse;

class PhpCsResponseStub
{
    const STANDARD = 'PSR2';

    /**
     * @param bool   $phpCs
     * @param string $phpCsStandard
     *
     * @return PhpCsResponse
     */
    public static function create($phpCs, $phpCsStandard)
    {
        return new PhpCsResponse($phpCs, $phpCsStandard);
    }

    /**
     * @return PhpCsResponse
     */
    public static function createEnabled()
    {
        return self::create(true, self::STANDARD);
    }
}
