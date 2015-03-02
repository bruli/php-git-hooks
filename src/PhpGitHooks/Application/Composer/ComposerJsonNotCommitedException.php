<?php

namespace PhpGitHooks\Application\Composer;

/**
 * Class ComposerJsonNotCommitedException.
 */
class ComposerJsonNotCommitedException extends \Exception
{
    protected $message = 'composer.lock must be commited if composer.json is modified!';
}
