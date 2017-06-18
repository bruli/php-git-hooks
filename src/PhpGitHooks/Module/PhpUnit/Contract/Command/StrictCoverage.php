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
     * StrictCoverageCommand constructor.
     *
     * @param float  $minimumCoverage
     * @param string $errorMessage
     */
    public function __construct($minimumCoverage, $errorMessage)
    {
        $this->minimumCoverage = $minimumCoverage;
        $this->errorMessage = $errorMessage;
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
}
