<?php

namespace PhpGitHooks\Application\PhpUnit;

final class PhpUnitConfigDataException extends \Exception
{
    protected $message = "Invalid entry for php-unit in your php-git-hooks.php file.\n
    'Please remove php-unit entry and execute composer install.";
}
