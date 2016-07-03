<?php

namespace PhpGitHooks\Module\Configuration\Contract\Response;

class PrePushResponse
{
    /**
     * @var PhpUnitResponse
     */
    private $phpUnit;
    /**
     * @var PhpUnitStrictCoverageResponse
     */
    private $phpUnitStrictCoverage;
    /**
     * @var bool
     */
    private $prePush;
    /**
     * @var string
     */
    private $rightMessage;
    /**
     * @var string
     */
    private $errorMessage;
    /**
     * @var PhpUnitGuardCoverageResponse
     */
    private $phpUnitGuardCoverage;

    /**
     * PrePushResponse constructor.
     *
     * @param bool                          $prePush
     * @param string                        $rightMessage
     * @param string                        $errorMessage
     * @param PhpUnitResponse               $phpUnit
     * @param PhpUnitStrictCoverageResponse $phpUnitStrictCoverage
     * @param PhpUnitGuardCoverageResponse  $phpUnitGuardCoverage
     */
    public function __construct(
        $prePush,
        $rightMessage,
        $errorMessage,
        PhpUnitResponse $phpUnit,
        PhpUnitStrictCoverageResponse $phpUnitStrictCoverage,
        PhpUnitGuardCoverageResponse $phpUnitGuardCoverage
    ) {
        $this->phpUnit = $phpUnit;
        $this->phpUnitStrictCoverage = $phpUnitStrictCoverage;
        $this->prePush = $prePush;
        $this->rightMessage = $rightMessage;
        $this->errorMessage = $errorMessage;
        $this->phpUnitGuardCoverage = $phpUnitGuardCoverage;
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
     * @return bool
     */
    public function isPrePush()
    {
        return $this->prePush;
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
     * @return PhpUnitGuardCoverageResponse
     */
    public function getPhpUnitGuardCoverage()
    {
        return $this->phpUnitGuardCoverage;
    }
}
