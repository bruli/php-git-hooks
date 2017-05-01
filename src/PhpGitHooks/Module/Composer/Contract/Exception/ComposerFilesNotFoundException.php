<?php

namespace PhpGitHooks\Module\Composer\Contract\Exception;

class ComposerFilesNotFoundException extends \Exception
{
    protected $message = 'If you change composer.json you must commit composer.lock too';
}
