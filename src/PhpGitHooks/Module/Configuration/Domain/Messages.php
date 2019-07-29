<?php

namespace PhpGitHooks\Module\Configuration\Domain;

class Messages
{
    /**
     * @var Message
     */
    private $rightMessage;
    /**
     * @var Message
     */
    private $errorMessage;

    /**
     * @var Enabled
     */
    private $enableFaces;

    /**
     * Messages constructor.
     *
     * @param Message $rightMessage
     * @param Message $errorMessage
     * @param Enabled $enableFaces
     */
    public function __construct(Message $rightMessage, Message $errorMessage, Enabled $enableFaces)
    {
        $this->rightMessage = $rightMessage;
        $this->errorMessage = $errorMessage;
        $this->enableFaces = $enableFaces;
    }

    /**
     * @return Message
     */
    public function getRightMessage()
    {
        return $this->rightMessage;
    }

    /**
     * @return Message
     */
    public function getErrorMessage()
    {
        return $this->errorMessage;
    }

    /**
     * @return Enabled
     */
    public function getEnableFaces()
    {
        return $this->enableFaces;
    }

    /**
     * @return Messages
     */
    public function disable()
    {
        return new self(
            new Message(null),
            new Message(null),
            new Enabled(true)
        );
    }
}
