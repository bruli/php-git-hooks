<?php

namespace Module\Configuration\Domain;

use Module\Configuration\Model\ExecuteInterface;
use Module\Configuration\Model\HookInterface;
use Module\Configuration\Model\ToolInterface;

class PreCommit implements HookInterface
{
    /**
     * @var Enabled
     */
    private $enabled;
    /**
     * @var ExecuteInterface
     */
    private $execute;
    /**
     * @var Undefined
     */
    private $undefined;
    /**
     * @var Messages
     */
    private $messages;

    /**
     * PreCommit constructor.
     *
     * @param Undefined        $undefined
     * @param Enabled          $enabled
     * @param ExecuteInterface $execute
     * @param Messages         $messages
     */
    public function __construct(Undefined $undefined, Enabled $enabled, ExecuteInterface $execute, Messages $messages)
    {
        $this->enabled = $enabled;
        $this->execute = $execute;
        $this->undefined = $undefined;
        $this->messages = $messages;
    }

    /**
     * @return bool
     */
    public function isEnabled()
    {
        return $this->enabled->value();
    }

    /**
     * @return ToolInterface|Execute
     */
    public function getExecute()
    {
        return $this->execute;
    }

    /**
     * @return bool
     */
    public function isUndefined()
    {
        return $this->undefined->value();
    }

    /**
     * @return Messages
     */
    public function getMessages()
    {
        return $this->messages;
    }

    /**
     * @param Enabled $enabled
     *
     * @return PreCommit
     */
    public function setEnabled(Enabled $enabled)
    {
        $execute = $this->execute;
        $messages = $this->messages;
        /** @var Execute $execute */
        $execute = false === $enabled->value() ? $execute->disableTools() : $execute;
        $messages = false === $enabled->value() ? $messages->disable() : $messages;

        return new self(
            new Undefined(false),
            $enabled,
            $execute,
            $messages
        );
    }

    /**
     * @param ExecuteInterface $execute
     *
     * @return PreCommit
     */
    public function setExecute(ExecuteInterface $execute)
    {
        return new self(
            $this->undefined,
            $this->enabled,
            $execute,
            $this->messages
        );
    }

    /**
     * @param Messages $messages
     *
     * @return PreCommit
     */
    public function setMessages(Messages $messages)
    {
        return new self(
            $this->undefined,
            $this->enabled,
            $this->execute,
            $messages
        );
    }
}
