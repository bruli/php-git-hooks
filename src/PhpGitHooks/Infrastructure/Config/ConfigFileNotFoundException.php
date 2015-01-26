<?php

namespace PhpGitHooks\Infrastructure\Config;

/**
 * Class ConfigFileNotFoundException
 * @package PhpGitHooks\Infrastructure\Config
 */
class ConfigFileNotFoundException extends \Exception
{
    protected $message = 'php-git-hooks.yml file not found';
}
