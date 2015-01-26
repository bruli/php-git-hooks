<?php

namespace PhpGitHooks\Infrastructure\PhpLint;

/**
 * Class PhpLintException
 * @package PhpGitHooks\Infrastructure\PhpLint
 */
class PhpLintException extends \Exception
{
    protected $message = "There are some PHP syntax errors!.";
}
