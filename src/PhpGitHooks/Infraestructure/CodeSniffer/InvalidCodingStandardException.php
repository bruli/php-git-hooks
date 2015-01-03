<?php

namespace PhpGitHooks\Infraestructure\CodeSniffer;

/**
 * Class InvalidCodingStandardException
 * @package PhpGitHooks\Infraestructure\PhpCsFixer
 */
class InvalidCodingStandardException extends \Exception
{
    protected $message = 'There are coding standards violations!';
}
