<?php

namespace PhpGitHooks\Module\Configuration\Contract\Response;

class PhpCsResponse
{
    /**
     * @var bool
     */
    private $phpCs;
    /**
     * @var null|string
     */
    private $phpCsStandard;

    /**
     * PhpCsResponse constructor.
     *
     * @param bool        $phpCs
     * @param string|null $phpCsStandard
     */
    public function __construct($phpCs, $phpCsStandard)
    {
        $this->phpCs = $phpCs;
        $this->phpCsStandard = $phpCsStandard;
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
}
