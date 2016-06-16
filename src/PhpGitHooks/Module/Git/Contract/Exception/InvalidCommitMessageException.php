<?php

namespace PhpGitHooks\Module\Git\Contract\Exception;

class InvalidCommitMessageException extends \Exception
{
    protected $message = 'Invalid Commit message: commit message for does not contain issue #<number> reference!';
}
