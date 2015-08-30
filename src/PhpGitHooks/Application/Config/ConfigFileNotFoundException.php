<?php

namespace PhpGitHooks\Application\Config;

/**
 * Class ConfigFileNotFoundException.
 */
class ConfigFileNotFoundException extends \Exception
{
    protected $message = 'php-git-hooks.yml file not found';
}
