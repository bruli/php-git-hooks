<?php

namespace PhpGitHooks\Infrastructure\PhpLint;

/**
 * Class PhpLintException.
 */
class PhpLintException extends \Exception
{
    protected $message = "There are some PHP syntax errors!.";
}
