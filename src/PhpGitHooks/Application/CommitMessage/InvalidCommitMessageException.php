<?php

namespace PhpGitHooks\Application\CommitMessage;

/**
 * Class InvalidCommitMessageException.
 */
class InvalidCommitMessageException extends \Exception
{
    protected $message = 'Invalid Commit message: commit message for does not contain issue #<number> reference!';
}
