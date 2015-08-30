<?php

namespace PhpGitHooks\Application\Composer;

/**
 * Class ComposerJsonNotCommittedException.
 */
class ComposerJsonNotCommittedException extends \Exception
{
    protected $message = 'composer.lock must be committed if composer.json is modified!';
}
