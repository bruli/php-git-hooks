<?php

namespace PhpGitHooks\Command;

/**
 * Class InMemoryOutputHandler.
 */
class InMemoryOutputHandler implements OutputHandlerInterface
{
    /**
     * @param string $title
     */
    public function setTitle($title)
    {
    }

    /**
     * @return string
     */
    public function getTitle()
    {
    }

    /**
     * @return string
     */
    public function getError()
    {
    }

    /**
     * @param string $error
     */
    public function setError($error)
    {
    }

    /**
     * @param null|string $message
     *
     * @return string
     */
    public function getSuccessfulStepMessage($message = null)
    {
    }
}
