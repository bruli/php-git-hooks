<?php
namespace PhpGitHooks\Infrastructure\PhpCsFixer;

/**
 * Class PhpCsFixerException.
 */
class PhpCsFixerException extends \Exception
{
    protected $message = "There are some PhpCsFixer styling errors!.";
}
