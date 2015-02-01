<?php

namespace PhpGitHooks\Command;

/**
 * Interface OutputHandlerInterface
 * @package PhpGitHooks\Command
 */
interface OutputHandlerInterface
{
    /**
     * @param string $title
     */
    public function setTitle($title);

    /**
     * @return string
     */
    public function getTitle();

    /**
     * @return string
     */
    public function getError();

    /**
     * @param string $error
     */
    public function setError($error);

    /**
     * @param null|string $message
     *
     * @return string
     */
    public function getSuccessfulStepMessage($message = null);
}
