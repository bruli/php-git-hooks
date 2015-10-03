<?php

namespace PhpGitHooks\Application\CodeSniffer;

final class InvalidPhpCsConfigDataException extends \Exception
{
    protected $message = "Invalid entry for phpcs in your php-git-hooks.php file.\n
    'Please remove phpcs entry and execute composer install.";
}
