<?php

namespace Module\Configuration\Contract\Response;

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
     * ConfigurationDataResponse constructor.
     *
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
     */
    public function __construct(
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
}
