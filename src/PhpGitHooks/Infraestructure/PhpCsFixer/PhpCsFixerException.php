<?php
namespace PhpGitHooks\Infraestructure\PhpCsFixer;

/**
 * Class PhpCsFixerException
 * @package PhpGitHooks\Infraestructure\PhpCsFixer
 */
class PhpCsFixerException extends \Exception
{
    protected $message = "There are some PhpCsFixer styling errors!.";
}
