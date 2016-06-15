<?php

namespace PhpGitHooks\Module\Composer\Contract\Exception;

class ComposerFilesNotFoundException extends \Exception
{
    protected $message = 'Composer files not found';
}
