<?php

namespace PhpGitHooks\Infrastructure\Config;

/**
 * Class InvalidConfigStructureException.
 */
class InvalidConfigStructureException extends \Exception
{
    protected $message = 'Invalid data structure in config file.';
}
