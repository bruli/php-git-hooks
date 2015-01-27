<?php

namespace PhpGitHooks\Application\CommitMessage;

/**
 * Class InvalidCommitMessageException
 * @package PhpGitHooks\Application\CommitMessage
 */
class InvalidCommitMessageException extends \Exception
{
    protected $message = 'Invalid Commit message: commit message for does not contain issue #<number> reference!';
}
