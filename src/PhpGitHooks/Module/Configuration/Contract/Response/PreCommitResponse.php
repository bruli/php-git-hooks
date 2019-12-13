<?php

namespace PhpGitHooks\Module\Configuration\Contract\Response;

class PreCommitResponse
{
    /**
     * @var bool
     */
    private $preCommit;
    /**
     * @var string
     */
    private $rightMessage;
    /**
     * @var string
     */
    private $errorMessage;
    /**
     * @var bool
     */
    private $enableFaces;
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
     * @var PhpMdResponse
     */
    private $phpMd;
    /**
     * @var PhpCsResponse
     */
    private $phpCs;
    /**
     * @var PhpCsFixerResponse
     */
    private $phpCsFixer;
    /**
     * @var PhpUnitResponse
     */
    private $phpUnit;
    /**
     * @var PhpUnitStrictCoverageResponse
     */
    private $phpUnitStrictCoverage;
    /**
     * @var PhpUnitGuardCoverageResponse
     */
    private $phpUnitGuardCoverage;

    /**
     * PreCommitResponse constructor.
     *
     * @param bool $preCommit
     * @param string $rightMessage
     * @param string $errorMessage
     * @param bool $enableFaces
     * @param bool $composer
     * @param bool $jsonLint
     * @param bool $phpLint
     * @param PhpMdResponse $phpMd
     * @param PhpCsResponse $phpCs
     * @param PhpCsFixerResponse $phpCsFixer
     * @param PhpUnitResponse $phpUnit
     * @param PhpUnitStrictCoverageResponse $phpUnitStrictCoverage
     * @param PhpUnitGuardCoverageResponse $phpUnitGuardCoverage
     */
    public function __construct(
        $preCommit,
        $rightMessage,
        $errorMessage,
        $enableFaces,
        $composer,
        $jsonLint,
        $phpLint,
        PhpMdResponse $phpMd,
        PhpCsResponse $phpCs,
        PhpCsFixerResponse $phpCsFixer,
        PhpUnitResponse $phpUnit,
        PhpUnitStrictCoverageResponse $phpUnitStrictCoverage,
        PhpUnitGuardCoverageResponse $phpUnitGuardCoverage
    ) {
        $this->preCommit = $preCommit;
        $this->rightMessage = $rightMessage;
        $this->errorMessage = $errorMessage;
        $this->enableFaces = $enableFaces;
        $this->composer = $composer;
        $this->jsonLint = $jsonLint;
        $this->phpLint = $phpLint;
        $this->phpMd = $phpMd;
        $this->phpCs = $phpCs;
        $this->phpCsFixer = $phpCsFixer;
        $this->phpUnit = $phpUnit;
        $this->phpUnitStrictCoverage = $phpUnitStrictCoverage;
        $this->phpUnitGuardCoverage = $phpUnitGuardCoverage;
    }

    /**
     * @return bool
     */
    public function isPreCommit()
    {
        return $this->preCommit;
    }

    /**
     * @return string
     */
    public function getRightMessage()
    {
        return $this->rightMessage;
    }

    /**
     * @return string
     */
    public function getErrorMessage()
    {
        return $this->errorMessage;
    }

    /**
     * @return bool
     */
    public function isEnableFaces()
    {
        return $this->enableFaces;
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
     * @return PhpMdResponse
     */
    public function getPhpMd()
    {
        return $this->phpMd;
    }

    /**
     * @return PhpCsResponse
     */
    public function getPhpCs()
    {
        return $this->phpCs;
    }

    /**
     * @return PhpCsFixerResponse
     */
    public function getPhpCsFixer()
    {
        return $this->phpCsFixer;
    }

    /**
     * @return PhpUnitResponse
     */
    public function getPhpUnit()
    {
        return $this->phpUnit;
    }

    /**
     * @return PhpUnitStrictCoverageResponse
     */
    public function getPhpUnitStrictCoverage()
    {
        return $this->phpUnitStrictCoverage;
    }

    /**
     * @return PhpUnitGuardCoverageResponse
     */
    public function getPhpUnitGuardCoverage()
    {
        return $this->phpUnitGuardCoverage;
    }
}
