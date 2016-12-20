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
     * @var string
     */
    private $ignore;

    /**
     * PhpCsResponse constructor.
     *
     * @param bool        $phpCs
     * @param string|null $phpCsStandard
     * @param string      $ignore
     */
    public function __construct($phpCs, $phpCsStandard, $ignore)
    {
        $this->phpCs = $phpCs;
        $this->phpCsStandard = $phpCsStandard;
        $this->ignore = $ignore;
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
     * @return string
     */
    public function getIgnore()
    {
        return $this->ignore;
    }
}
