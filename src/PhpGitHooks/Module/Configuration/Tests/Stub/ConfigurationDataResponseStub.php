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
     * @param bool        $preCommit
     * @param string|null $rightMessage
     * @param string|null $errorMessage
     * @param bool        $composer
     * @param bool        $jsonLint
     * @param bool        $phpLint
     * @param bool        $phpMd
     * @param bool        $phpCs
     * @param string|null $phpCsStandard
     * @param bool        $phpCsFixer
     * @param bool        $phpCsFixerPsr0
     * @param bool        $phpCsFixerPsr1
     * @param bool        $phpCsFixerPsr2
     * @param bool        $phpCsFixerSymfony
     * @param bool        $phpunit
     * @param bool        $phpunitRandomMode
     * @param string|null $phpunitOptions
     * @param bool        $commitMsg
     * @param string|null $regularExpression
     *
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
        $regularExpression
    ) {
        return new ConfigurationDataResponse(
            $preCommit,
            $rightMessage,
            $errorMessage,
            $composer,
            $jsonLint,
            $phpLint,
            $phpMd,
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
            $regularExpression
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
            null
        );
    }

    /**
     * @param bool $preCommit
     * @param bool $commitMsg
     *
     * @return ConfigurationDataResponse
     */
    public static function createCustom($preCommit, $commitMsg)
    {
        return static::create(
            $preCommit,
            static::GOOD_JOB,
            static::FIX_YOUR_CODE,
            $preCommit,
            $preCommit,
            $preCommit,
            $preCommit,
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
            HookQuestions::COMMIT_MSG_REGULAR_EXPRESSION_ANSWER
        );
    }
}
