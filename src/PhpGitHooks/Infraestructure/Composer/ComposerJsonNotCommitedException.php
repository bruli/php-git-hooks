<?php

namespace PhpGitHooks\Infraestructure\Composer;

/**
 * Class ComposerJsonNotCommitedException
 * @package PhpGitHooks\Infraestructure\Composer
 */
class ComposerJsonNotCommitedException extends \Exception
{
    protected $message = 'composer.lock must be commited if composer.json is modified!';
}
