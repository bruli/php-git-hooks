<?php

namespace PhpGitHooks\Module\Configuration\Tests\Stub;

use PhpGitHooks\Module\Configuration\Contract\Response\PhpUnitGuardCoverageResponse;

class PhpUnitGuardCoverageResponseStub
{
    const WARNING_MESSAGE = 'warning message';

    /**
     * @param bool   $enabled
     * @param string $warningMessage
     *
     * @return PhpUnitGuardCoverageResponse
     */
    public static function create($enabled, $warningMessage)
    {
        return new PhpUnitGuardCoverageResponse($enabled, $warningMessage);
    }

    /**
     * @return PhpUnitGuardCoverageResponse
     */
    public static function createEnabled()
    {
        return self::create(true, self::WARNING_MESSAGE);
    }
}
