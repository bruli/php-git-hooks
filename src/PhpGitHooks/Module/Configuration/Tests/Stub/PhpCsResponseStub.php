<?php

namespace PhpGitHooks\Module\Configuration\Tests\Stub;

use PhpGitHooks\Module\Configuration\Contract\Response\PhpCsResponse;

class PhpCsResponseStub
{
    const STANDARD = 'PSR2';
    const IGNORE = '';

    /**
     * @param bool   $phpCs
     * @param string $phpCsStandard
     * @param string $ignore
     *
     * @return PhpCsResponse
     */
    public static function create($phpCs, $phpCsStandard, $ignore)
    {
        return new PhpCsResponse($phpCs, $phpCsStandard, $ignore);
    }

    /**
     * @return PhpCsResponse
     */
    public static function createEnabled()
    {
        return self::create(true, self::STANDARD, self::IGNORE);
    }
}
