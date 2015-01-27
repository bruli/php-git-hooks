<?php

namespace PhpGitHooks\Application\Composer;

/**
 * Class ComposerJsonNotCommitedException
 * @package PhpGitHooks\Application\Composer
 */
class ComposerJsonNotCommitedException extends \Exception
{
    protected $message = 'composer.lock must be commited if composer.json is modified!';
}
