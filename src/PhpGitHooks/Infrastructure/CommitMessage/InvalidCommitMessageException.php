<?php

namespace PhpGitHooks\Infrastructure\CommitMessage;

/**
 * Class InvalidCommitMessageException
 * @package PhpGitHooks\Infrastructure\CommitMessage
 */
class InvalidCommitMessageException extends \Exception
{
    protected $message = 'Invalid Commit message: commit message for does not contain issue #<number> reference!';
}
