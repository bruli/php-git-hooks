<?php

namespace PhpGitHooks\Module\Configuration\Tests\Stub;

use PhpGitHooks\Module\Configuration\Contract\Response\ConfigurationDataResponse;
use PhpGitHooks\Module\Configuration\Service\HookQuestions;

final class ConfigurationDataResponseStub
{
    const PHPCS_STANDARD = 'PSR2';
    const FIX_YOUR_CODE = 'Fix your code';
    const GOOD_JOB = 'Good job';
    const MINIMUM_COVERAGE = 100.00;

    /**
     * @param bool $preCommit
     * @param string|null $rightMessage
     * @param string|null $errorMessage
     * @param bool $composer
     * @param bool $jsonLint
     * @param bool $phpLint
     * @param bool $phpMd
     * @param string|null $phpMdOptions
     * @param bool $phpCs
     * @param string|null $phpCsStandard
     * @param bool $phpCsFixer
     * @param bool $phpCsFixerPsr0
     * @param bool $phpCsFixerPsr1
     * @param bool $phpCsFixerPsr2
     * @param bool $phpCsFixerSymfony
     * @param bool $phpunit
     * @param bool $phpunitRandomMode
     * @param string|null $phpunitOptions
     * @param bool $phpunitStrictCoverage
     * @param float $phpunitMinimumCoverage
     * @param bool $commitMsg
     * @param string|null $regularExpression
     * @param bool $prePush
     * @param bool $prePushPhpUnit
     * @param bool $prePushPhpUnitRandom
     * @param string|null $prePushPhpUnitOptions
     * @param bool $prePushStrictCoverage
     * @param float $prePushMinimum
     * @param string $prePushRightMessage
     * @param string $prePushErrorMessage
     * @return ConfigurationDataResponse
     */
    public static function create(
        $preCommit,
        $rightMessage,
        $errorMessage,
        $composer,
        $jsonLint,
        $phpLint,
        $phpMd,
        $phpMdOptions,
        $phpCs,
        $phpCsStandard,
        $phpCsFixer,
        $phpCsFixerPsr0,
        $phpCsFixerPsr1,
        $phpCsFixerPsr2,
        $phpCsFixerSymfony,
        $phpunit,
        $phpunitRandomMode,
        $phpunitOptions,
        $phpunitStrictCoverage,
        $phpunitMinimumCoverage,
        $commitMsg,
        $regularExpression,
        $prePush,
        $prePushPhpUnit,
        $prePushPhpUnitRandom,
        $prePushPhpUnitOptions,
        $prePushStrictCoverage,
        $prePushMinimum,
        $prePushRightMessage,
        $prePushErrorMessage
    ) {
        return new ConfigurationDataResponse(
            $preCommit,
            $rightMessage,
            $errorMessage,
            $composer,
            $jsonLint,
            $phpLint,
            $phpMd,
            $phpMdOptions,
            $phpCs,
            $phpCsStandard,
            $phpCsFixer,
            $phpCsFixerPsr0,
            $phpCsFixerPsr1,
            $phpCsFixerPsr2,
            $phpCsFixerSymfony,
            $phpunit,
            $phpunitRandomMode,
            $phpunitOptions,
            $phpunitStrictCoverage,
            $phpunitMinimumCoverage,
            $commitMsg,
            $regularExpression,
            $prePush,
            $prePushPhpUnit,
            $prePushPhpUnitRandom,
            $prePushPhpUnitOptions,
            $prePushStrictCoverage,
            $prePushMinimum,
            $prePushRightMessage,
            $prePushErrorMessage
        );
    }

    /**
     * @return ConfigurationDataResponse
     */
    public static function createAllEnabled()
    {
        $bool = true;

        return static::create(
            $bool,
            static::GOOD_JOB,
            static::FIX_YOUR_CODE,
            $bool,
            $bool,
            $bool,
            $bool,
            null,
            $bool,
            static::PHPCS_STANDARD,
            $bool,
            $bool,
            $bool,
            $bool,
            $bool,
            $bool,
            $bool,
            null,
            $bool,
            self::MINIMUM_COVERAGE,
            $bool,
            null,
            $bool,
            $bool,
            $bool,
            null,
            $bool,
            static::MINIMUM_COVERAGE,
            static::GOOD_JOB,
            static::FIX_YOUR_CODE
        );
    }

    /**
     * @param bool $preCommit
     * @param bool $commitMsg
     * @param bool $prePush
     *
     * @return ConfigurationDataResponse
     */
    public static function createCustom($preCommit, $commitMsg, $prePush)
    {
        return static::create(
            $preCommit,
            static::GOOD_JOB,
            static::FIX_YOUR_CODE,
            $preCommit,
            $preCommit,
            $preCommit,
            $preCommit,
            null,
            $preCommit,
            static::PHPCS_STANDARD,
            $preCommit,
            $preCommit,
            $preCommit,
            $preCommit,
            $preCommit,
            $preCommit,
            $preCommit,
            null,
            $preCommit,
            static::MINIMUM_COVERAGE,
            $commitMsg,
            HookQuestions::COMMIT_MSG_REGULAR_EXPRESSION_ANSWER,
            $prePush,
            $prePush,
            $prePush,
            null,
            $prePush,
            static::MINIMUM_COVERAGE,
            null,
            null
        );
    }
}
