<?php

namespace PhpGitHooks\Module\Configuration\Domain;

use PhpGitHooks\Module\Configuration\Model\ExecuteInterface;
use PhpGitHooks\Module\Configuration\Model\HookInterface;

class PrePush implements HookInterface
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
     * @var ExecuteInterface
     */
    private $execute;
    /**
     * @var Messages
     */
    private $messages;

    /**
     * PrePush constructor.
     *
     * @param Undefined        $undefined
     * @param Enabled          $enabled
     * @param ExecuteInterface $execute
     * @param Messages         $messages
     */
    public function __construct(Undefined $undefined, Enabled $enabled, ExecuteInterface $execute, Messages $messages)
    {
        $this->undefined = $undefined;
        $this->enabled = $enabled;
        $this->execute = $execute;
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
     * @return bool
     */
    public function isUndefined()
    {
        return $this->undefined->value();
    }

    /**
     * @return ExecuteInterface
     */
    public function getExecute()
    {
        return $this->execute;
    }

    /**
     * @return Messages
     */
    public function getMessages()
    {
        return $this->messages;
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
     * @param Enabled $enabled
     *
     * @return PrePush
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
     * @param Messages $messages
     *
     * @return PrePush
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
