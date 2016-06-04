<?php

namespace Module\Configuration\Tests\Stub;

use Module\Configuration\Contract\Response\ConfigurationDataResponse;

class ConfigurationDataResponseStub
{
    const PHPCS_STANDARD = 'PSR2';

    /**
     * @param bool        $preCommit
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

        return self::create(
            $bool,
            $bool,
            $bool,
            $bool,
            $bool,
            $bool,
            self::PHPCS_STANDARD,
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
}
