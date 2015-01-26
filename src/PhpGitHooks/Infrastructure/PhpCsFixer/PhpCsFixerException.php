<?php
namespace PhpGitHooks\Infrastructure\PhpCsFixer;

/**
 * Class PhpCsFixerException
 * @package PhpGitHooks\Infrastructure\PhpCsFixer
 */
class PhpCsFixerException extends \Exception
{
    protected $message = "There are some PhpCsFixer styling errors!.";
}
