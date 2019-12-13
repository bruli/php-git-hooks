<?php

namespace PhpGitHooks\Module\PhpUnit\Contract\Command;

use Bruli\EventBusBundle\CommandBus\CommandInterface;

class StrictCoverage implements CommandInterface
{
    /**
     * @var float
     */
    private $minimumCoverage;
    /**
     * @var string
     */
    private $errorMessage;
    /**
     * @var bool
     */
    private $enableFaces;

    /**
     * StrictCoverageCommand constructor.
     *
     * @param float $minimumCoverage
     * @param string $errorMessage
     * @param bool $enableFaces
     */
    public function __construct($minimumCoverage, $errorMessage, $enableFaces)
    {
        $this->minimumCoverage = $minimumCoverage;
        $this->errorMessage = $errorMessage;
        $this->enableFaces = $enableFaces;
    }

    /**
     * @return float
     */
    public function getMinimumCoverage()
    {
        return $this->minimumCoverage;
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
}
