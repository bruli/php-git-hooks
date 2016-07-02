<?php

namespace PhpGitHooks\Module\PhpUnit\Contract\Command;

use PhpGitHooks\Infrastructure\CommandBus\CommandBus\CommandInterface;

class GuardCoverageCommand implements CommandInterface
{
    /**
     * @var string
     */
    private $warningMessage;

    /**
     * GuardCoverageCommand constructor.
     *
     * @param string $warningMessage
     */
    public function __construct($warningMessage)
    {
        $this->warningMessage = $warningMessage;
    }

    /**
     * @return string
     */
    public function getWarningMessage()
    {
        return $this->warningMessage;
    }
}
