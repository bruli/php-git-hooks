<?php

namespace PhpGitHooks\Module\Configuration\Domain;

use PhpGitHooks\Module\Configuration\Model\ToolInterface;

class PhpUnitGuardCoverage implements ToolInterface
{
    /**
     * @var Undefined
     */
    private $undefined;
    /**
     * @var Enabled
     */
    private $enabled;
    /**
     * @var Message
     */
    private $warningMessage;

    /**
     * PhpUnitGuardCoverage constructor.
     *
     * @param Undefined $undefined
     * @param Enabled   $enabled
     * @param Message   $warningMessage
     */
    public function __construct(Undefined $undefined, Enabled $enabled, Message $warningMessage)
    {
        $this->undefined = $undefined;
        $this->enabled = $enabled;
        $this->warningMessage = $warningMessage;
    }

    /**
     * @return bool
     */
    public function isEnabled()
    {
        return $this->enabled->value();
    }

    /**
     * @return bool
     */
    public function isUndefined()
    {
        return $this->undefined->value();
    }

    /**
     * @return Message
     */
    public function getWarningMessage()
    {
        return $this->warningMessage;
    }

    /**
     * @param Enabled $enabled
     *
     * @return PhpUnitGuardCoverage
     */
    public function setEnabled(Enabled $enabled)
    {
        return new self(
            new Undefined(false),
            $enabled,
            $this->warningMessage
        );
    }

    /**
     * @param Message $message
     *
     * @return PhpUnitGuardCoverage
     */
    public function setWarningMessage(Message $message)
    {
        return new self(
            $this->undefined,
            $this->enabled,
            $message
        );
    }
}
