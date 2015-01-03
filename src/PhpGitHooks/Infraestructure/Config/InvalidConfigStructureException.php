<?php

namespace PhpGitHooks\Infraestructure\Config;

/**
 * Class InvalidConfigStructureException
 * @package PhpGitHooks\Infraestructure\Config
 */
class InvalidConfigStructureException extends \Exception
{
    protected $message = 'Invalid data structure in config file.';
}
