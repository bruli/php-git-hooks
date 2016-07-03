<?php

namespace PhpGitHooks\Module\Configuration\Tests\Stub;

use PhpGitHooks\Module\Configuration\Contract\Response\PhpCsFixerResponse;
use PhpGitHooks\Module\Configuration\Contract\Response\PhpCsResponse;
use PhpGitHooks\Module\Configuration\Contract\Response\PhpMdResponse;
use PhpGitHooks\Module\Configuration\Contract\Response\PhpUnitGuardCoverageResponse;
use PhpGitHooks\Module\Configuration\Contract\Response\PhpUnitResponse;
use PhpGitHooks\Module\Configuration\Contract\Response\PhpUnitStrictCoverageResponse;
use PhpGitHooks\Module\Configuration\Contract\Response\PreCommitResponse;

class PreCommitResponseStub
{
    const PHPCS_STANDARD = 'PSR2';
    const FIX_YOUR_CODE = 'Fix your code';
    const GOOD_JOB = 'Good job';
    const MINIMUM_COVERAGE = 100.00;

    /**
     * @param bool                          $preCommit
     * @param string                        $rightMessage
     * @param string                        $errorMessage
     * @param bool                          $composer
     * @param bool                          $jsonLint
     * @param bool                          $phpLint
     * @param PhpMdResponse                 $pmdResponse
     * @param PhpCsResponse                 $phpCsResponse
     * @param PhpCsFixerResponse            $phpCsFixerResponse
     * @param PhpUnitResponse               $phpUnitResponse
     * @param PhpUnitStrictCoverageResponse $phpUnitStrictCoverageResponse
     * @param PhpUnitGuardCoverageResponse  $phpUnitGuardCoverageResponse
     *
     * @return PreCommitResponse
     */
    public static function create(
        $preCommit,
        $rightMessage,
        $errorMessage,
        $composer,
        $jsonLint,
        $phpLint,
        PhpMdResponse $pmdResponse,
        PhpCsResponse $phpCsResponse,
        PhpCsFixerResponse $phpCsFixerResponse,
        PhpUnitResponse $phpUnitResponse,
        PhpUnitStrictCoverageResponse $phpUnitStrictCoverageResponse,
        PhpUnitGuardCoverageResponse $phpUnitGuardCoverageResponse
    ) {
        return new PreCommitResponse(
            $preCommit,
            $rightMessage,
            $errorMessage,
            $composer,
            $jsonLint,
            $phpLint,
            $pmdResponse,
            $phpCsResponse,
            $phpCsFixerResponse,
            $phpUnitResponse,
            $phpUnitStrictCoverageResponse,
            $phpUnitGuardCoverageResponse
        );
    }

    /**
     * @return PreCommitResponse
     */
    public static function createAllEnabled()
    {
        $bool = true;

        return self::create(
            $bool,
            static::GOOD_JOB,
            static::FIX_YOUR_CODE,
            $bool,
            $bool,
            $bool,
            PhpMdResponseStub::createEnabled(),
            PhpCsResponseStub::createEnabled(),
            PhpCsFixerResponseStub::createEnabled(),
            PhpUnitResponseStub::createEnabled(),
            PhpUnitStrictCoverageResponseStub::createEnabled(),
            PhpUnitGuardCoverageResponseStub::createEnabled()
        );
    }
}
