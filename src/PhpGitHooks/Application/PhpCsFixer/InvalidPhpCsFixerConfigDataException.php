<?php

namespace PhpGitHooks\Application\PhpCsFixer;

final class InvalidPhpCsFixerConfigDataException extends \Exception
{
    protected $message = 'Invalid entry for php-cs-fixer in your php-git-hooks.php file.' . "\n" .
    'Please remove php-cs-fixer entry and execute composer install.';
}
