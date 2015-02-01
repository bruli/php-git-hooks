<?php

namespace PhpGitHooks\Command;

/**
 * Class InMemoryOutputHandler
 * @package PhpGitHooks\Command
 */
class InMemoryOutputHandler implements OutputHandlerInterface
{
    /**
     * @param string $title
     */
    public function setTitle($title)
    {
        // TODO: Implement setTitle() method.
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        // TODO: Implement getTitle() method.
    }

    /**
     * @return string
     */
    public function getError()
    {
        // TODO: Implement getError() method.
    }

    /**
     * @param string $error
     */
    public function setError($error)
    {
        // TODO: Implement setError() method.
    }

    /**
     * @param null|string $message
     *
     * @return string
     */
    public function getSuccessfulStepMessage($message = null)
    {
        // TODO: Implement getSuccessfulStepMessage() method.
    }
}
