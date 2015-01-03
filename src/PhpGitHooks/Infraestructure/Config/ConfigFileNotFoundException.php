<?php


namespace PhpGitHooks\Infraestructure\Config;

/**
 * Class ConfigFileNotFoundException
 * @package PhpGitHooks\Infraestructure\Config
 */
class ConfigFileNotFoundException extends \Exception
{
    protected $message = 'php-git-hooks.yml file not found';
}
