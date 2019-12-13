<?php

namespace PhpGitHooks\Module\Configuration\Tests\Stub;

use PhpGitHooks\Module\Configuration\Contract\Response\PhpUnitGuardCoverageResponse;
use PhpGitHooks\Module\Configuration\Contract\Response\PhpUnitResponse;
use PhpGitHooks\Module\Configuration\Contract\Response\PhpUnitStrictCoverageResponse;
use PhpGitHooks\Module\Configuration\Contract\Response\PrePushResponse;

class PrePushResponseStub
{
    const RIGHT_MESSAGE = 'OK';
    const ERROR_MESSAGE = 'BAD PUSH';

    /**
     * @param bool $prePush
     * @param string $rightMessage
     * @param string $errorMessage
     * @param bool $enableFaces
     * @param PhpUnitResponse $phpUnitResponse
     * @param PhpUnitStrictCoverageResponse $phpUnitStrictCoverageResponse
     * @param PhpUnitGuardCoverageResponse $phpUnitGuardCoverageResponse
     *
     * @return PrePushResponse
     */
    public static function create(
        $prePush,
        $rightMessage,
        $errorMessage,
        $enableFaces,
        PhpUnitResponse $phpUnitResponse,
        PhpUnitStrictCoverageResponse $phpUnitStrictCoverageResponse,
        PhpUnitGuardCoverageResponse $phpUnitGuardCoverageResponse
    ) {
        return new PrePushResponse(
            $prePush,
            $rightMessage,
            $errorMessage,
            $enableFaces,
            $phpUnitResponse,
            $phpUnitStrictCoverageResponse,
            $phpUnitGuardCoverageResponse
        );
    }

    /**
     * @return PrePushResponse
     */
    public static function createAllEnabled()
    {
        return new PrePushResponse(
            true,
            self::RIGHT_MESSAGE,
            self::ERROR_MESSAGE,
            true,
            PhpUnitResponseStub::createEnabled(),
            PhpUnitStrictCoverageResponseStub::createEnabled(),
            PhpUnitGuardCoverageResponseStub::createEnabled()
        );
    }
}
