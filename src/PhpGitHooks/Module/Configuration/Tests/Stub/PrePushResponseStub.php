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
     * @param $prePush
     * @param $rightMessage
     * @param $errorMessage
     * @param PhpUnitResponse               $phpUnitResponse
     * @param PhpUnitStrictCoverageResponse $phpUnitStrictCoverageResponse
     * @param PhpUnitGuardCoverageResponse  $phpUnitGuardCoverageResponse
     *
     * @return PrePushResponse
     */
    public static function create(
        $prePush,
        $rightMessage,
        $errorMessage,
        PhpUnitResponse $phpUnitResponse,
        PhpUnitStrictCoverageResponse $phpUnitStrictCoverageResponse,
        PhpUnitGuardCoverageResponse $phpUnitGuardCoverageResponse
    ) {
        return new PrePushResponse(
            $prePush,
            $rightMessage,
            $errorMessage,
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
            PhpUnitResponseStub::createEnabled(),
            PhpUnitStrictCoverageResponseStub::createEnabled(),
            PhpUnitGuardCoverageResponseStub::createEnabled()
        );
    }
}
