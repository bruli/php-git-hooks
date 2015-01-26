<?php

namespace PhpGitHooks\Infrastructure\CodeSniffer;

/**
 * Class InvalidCodingStandardException
 * @package PhpGitHooks\Infrastructure\PhpCsFixer
 */
class InvalidCodingStandardException extends \Exception
{
    protected $message = 'There are coding standards violations!';
}
