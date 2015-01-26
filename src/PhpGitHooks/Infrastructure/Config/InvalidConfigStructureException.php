<?php

namespace PhpGitHooks\Infrastructure\Config;

/**
 * Class InvalidConfigStructureException
 * @package PhpGitHooks\Infrastructure\Config
 */
class InvalidConfigStructureException extends \Exception
{
    protected $message = 'Invalid data structure in config file.';
}
