<?php

namespace PhpGitHooks\Infrastructure\CodeSniffer;

/**
 * Class InvalidCodingStandardException.
 */
class InvalidCodingStandardException extends \Exception
{
    protected $message = 'There are coding standards violations!';
}
