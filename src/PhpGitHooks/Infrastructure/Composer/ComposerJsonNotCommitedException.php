<?php

namespace PhpGitHooks\Infrastructure\Composer;

/**
 * Class ComposerJsonNotCommitedException
 * @package PhpGitHooks\Infrastructure\Composer
 */
class ComposerJsonNotCommitedException extends \Exception
{
    protected $message = 'composer.lock must be commited if composer.json is modified!';
}
