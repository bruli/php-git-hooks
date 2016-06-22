<?php

namespace PhpGitHooks\Module\Configuration\Contract\Response;

class ConfigurationDataResponse
{
    /**
     * @var bool
     */
    private $composer;
    /**
     * @var bool
     */
    private $jsonLint;
    /**
     * @var bool
     */
    private $phpLint;
    /**
     * @var bool
     */
    private $phpMd;
    /**
     * @var bool
     */
    private $phpCs;
    /**
     * @var null|string
     */
    private $phpCsStandard;
    /**
     * @var bool
     */
    private $phpCsFixer;
    /**
     * @var bool
     */
    private $phpCsFixerPsr0;
    /**
     * @var bool
     */
    private $phpCsFixerPsr1;
    /**
     * @var bool
     */
    private $phpCsFixerPsr2;
    /**
     * @var bool
     */
    private $phpCsFixerSymfony;
    /**
     * @var bool
     */
    private $phpunit;
    /**
     * @var bool
     */
    private $phpunitRandomMode;
    /**
     * @var null|string
     */
    private $phpunitOptions;
    /**
     * @var bool
     */
    private $preCommit;
    /**
     * @var bool
     */
    private $commitMsg;
    /**
     * @var null|string
     */
    private $regularExpression;
    /**
     * @var null|string
     */
    private $rightMessage;
    /**
     * @var null|string
     */
    private $errorMessage;
    /**
     * @var bool
     */
    private $prePush;
    /**
     * @var bool
     */
    private $prePushPhpUnit;
    /**
     * @var bool
     */
    private $prePushPhpUnitRandom;
    /**
     * @var null|string
     */
    private $prePushPhpUnitOptions;
    private $prePushRightMessage;
    private $prePushErrorMessage;
    /**
     * @var null|string
     */
    private $phpMdOptions;

    /**
     * ConfigurationDataResponse constructor.
     *
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
     */
    public function __construct(
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
        $this->composer = $composer;
        $this->jsonLint = $jsonLint;
        $this->phpLint = $phpLint;
        $this->phpMd = $phpMd;
        $this->phpCs = $phpCs;
        $this->phpCsStandard = $phpCsStandard;
        $this->phpCsFixer = $phpCsFixer;
        $this->phpCsFixerPsr0 = $phpCsFixerPsr0;
        $this->phpCsFixerPsr1 = $phpCsFixerPsr1;
        $this->phpCsFixerPsr2 = $phpCsFixerPsr2;
        $this->phpCsFixerSymfony = $phpCsFixerSymfony;
        $this->phpunit = $phpunit;
        $this->phpunitRandomMode = $phpunitRandomMode;
        $this->phpunitOptions = $phpunitOptions;
        $this->preCommit = $preCommit;
        $this->commitMsg = $commitMsg;
        $this->regularExpression = $regularExpression;
        $this->rightMessage = $rightMessage;
        $this->errorMessage = $errorMessage;
        $this->prePush = $prePush;
        $this->prePushPhpUnit = $prePushPhpUnit;
        $this->prePushPhpUnitRandom = $prePushPhpUnitRandom;
        $this->prePushPhpUnitOptions = $prePushPhpUnitOptions;
        $this->prePushRightMessage = $prePushRightMessage;
        $this->prePushErrorMessage = $prePushErrorMessage;
        $this->phpMdOptions = $phpMdOptions;
    }

    /**
     * @return bool
     */
    public function isComposer()
    {
        return $this->composer;
    }

    /**
     * @return bool
     */
    public function isJsonLint()
    {
        return $this->jsonLint;
    }

    /**
     * @return bool
     */
    public function isPhpLint()
    {
        return $this->phpLint;
    }

    /**
     * @return bool
     */
    public function isPhpMd()
    {
        return $this->phpMd;
    }

    /**
     * @return null|string
     */
    public function getRightMessage()
    {
        return $this->rightMessage;
    }

    /**
     * @return null|string
     */
    public function getErrorMessage()
    {
        return $this->errorMessage;
    }

    /**
     * @return bool
     */
    public function isPhpCs()
    {
        return $this->phpCs;
    }

    /**
     * @return null|string
     */
    public function getPhpCsStandard()
    {
        return $this->phpCsStandard;
    }

    /**
     * @return bool
     */
    public function isPhpCsFixer()
    {
        return $this->phpCsFixer;
    }

    /**
     * @return bool
     */
    public function isPhpCsFixerPsr0()
    {
        return $this->phpCsFixerPsr0;
    }

    /**
     * @return bool
     */
    public function isPhpCsFixerPsr1()
    {
        return $this->phpCsFixerPsr1;
    }

    /**
     * @return bool
     */
    public function isPhpCsFixerPsr2()
    {
        return $this->phpCsFixerPsr2;
    }

    /**
     * @return bool
     */
    public function isPhpCsFixerSymfony()
    {
        return $this->phpCsFixerSymfony;
    }

    /**
     * @return bool
     */
    public function isPhpunit()
    {
        return $this->phpunit;
    }

    /**
     * @return bool
     */
    public function isPhpunitRandomMode()
    {
        return $this->phpunitRandomMode;
    }

    /**
     * @return null|string
     */
    public function getPhpunitOptions()
    {
        return $this->phpunitOptions;
    }

    /**
     * @return bool
     */
    public function isPreCommit()
    {
        return $this->preCommit;
    }

    /**
     * @return bool
     */
    public function isCommitMsg()
    {
        return $this->commitMsg;
    }

    /**
     * @return null|string
     */
    public function getRegularExpression()
    {
        return $this->regularExpression;
    }

    /**
     * @return bool
     */
    public function isPrePush()
    {
        return $this->prePush;
    }

    /**
     * @return bool
     */
    public function isPrePushPhpUnit()
    {
        return $this->prePushPhpUnit;
    }

    /**
     * @return bool
     */
    public function isPrePushPhpUnitRandom()
    {
        return $this->prePushPhpUnitRandom;
    }

    /**
     * @return null|string
     */
    public function getPrePushPhpUnitOptions()
    {
        return $this->prePushPhpUnitOptions;
    }

    /**
     * @return string
     */
    public function getPrePushRightMessage()
    {
        return $this->prePushRightMessage;
    }

    /**
     * @return string
     */
    public function getPrePushErrorMessage()
    {
        return $this->prePushErrorMessage;
    }

    /**
     * @return null|string
     */
    public function getPhpMdOptions()
    {
        return $this->phpMdOptions;
    }
}
