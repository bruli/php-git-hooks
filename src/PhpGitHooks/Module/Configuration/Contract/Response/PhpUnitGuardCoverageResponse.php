<?php

namespace PhpGitHooks\Module\Configuration\Contract\Response;

class PhpUnitGuardCoverageResponse
{
    /**
     * @var string
     */
    private $warningMessage;
    /**
     * @var bool
     */
    private $enabled;

    /**
     * PhpUnitGuardCoverageResponse constructor.
     *
     * @param bool   $enabled
     * @param string $warningMessage
     */
    public function __construct($enabled, $warningMessage)
    {
        $this->warningMessage = $warningMessage;
        $this->enabled = $enabled;
    }

    /**
     * @return string
     */
    public function getWarningMessage()
    {
        return $this->warningMessage;
    }

    /**
     * @return bool
     */
    public function getEnabled()
    {
        return $this->enabled;
    }
}
