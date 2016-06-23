<?php

namespace PhpGitHooks\Module\PhpCs\Contract\Exception;

class PhpCsViolationException extends \Exception
{
    protected $message = 'There are coding standards violations!';
}
