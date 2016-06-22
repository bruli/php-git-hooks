<?php

namespace PhpGitHooks\Module\Configuration\Tests\Stub;

use PhpGitHooks\Module\Configuration\Contract\Response\ConfigurationDataResponse;
use PhpGitHooks\Module\Configuration\Service\HookQuestions;

final class ConfigurationDataResponseStub
{
    const PHPCS_STANDARD = 'PSR2';
    const FIX_YOUR_CODE = 'Fix your code';
    const GOOD_JOB = 'Good job';

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
     * @param bool $commitMsg
     * @param string|null $regularExpression
     * @param bool $prePush
     * @param bool $prePushPhpUnit
     * @param bool $prePushPhpUnitRandom
     * @param string|null $prePushPhpUnitOptions
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
        $commitMsg,
        $regularExpression,
        $prePush,
        $prePushPhpUnit,
        $prePushPhpUnitRandom,
        $prePushPhpUnitOptions,
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
            $commitMsg,
            $regularExpression,
            $prePush,
            $prePushPhpUnit,
            $prePushPhpUnitRandom,
            $prePushPhpUnitOptions,
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
            null,
            $bool,
            $bool,
            $bool,
            null,
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
            $commitMsg,
            HookQuestions::COMMIT_MSG_REGULAR_EXPRESSION_ANSWER,
            $prePush,
            $prePush,
            $prePush,
            null,
            null,
            null
        );
    }
}
