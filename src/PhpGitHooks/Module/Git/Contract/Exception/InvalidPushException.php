<?php

namespace PhpGitHooks\Module\Git\Contract\Exception;

class InvalidPushException extends \Exception
{
    protected $message = 'You can not push your code!!';
}
