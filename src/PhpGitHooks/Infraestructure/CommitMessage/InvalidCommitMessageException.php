<?php

namespace PhpGitHooks\Infraestructure\CommitMessage;

/**
 * Class InvalidCommitMessageException
 * @package PhpGitHooks\Infraestructure\CommitMessage
 */
class InvalidCommitMessageException extends \Exception
{
    protected  $message = 'Invalid Commit message: commit message for does not contain issue #<number> reference!';
}