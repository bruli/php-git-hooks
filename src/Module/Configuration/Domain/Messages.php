<?php

namespace Module\Configuration\Domain;

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
     * Messages constructor.
     *
     * @param Message $rightMessage
     * @param Message $errorMessage
     */
    public function __construct(Message $rightMessage, Message $errorMessage)
    {
        $this->rightMessage = $rightMessage;
        $this->errorMessage = $errorMessage;
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
     * @return Messages
     */
    public function disable()
    {
        return new self(
            new Message(null),
            new Message(null)
        );
    }
}
