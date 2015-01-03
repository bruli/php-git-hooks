<?php

namespace PhpGitHooks\Infraestructure\PhpLint;

/**
 * Class PhpLintException
 * @package PhpGitHooks\Infraestructure\PhpLint
 */
class PhpLintException extends \Exception
{
    protected $message = "There are some PHP syntax errors!.";
}
