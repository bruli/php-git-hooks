<?php

namespace PhpGitHooks\Infrastructure\Git;

/**
 * Interface MergeValidatorInterface
 * @package PhpGitHooks\Infrastructure\Git
 */
interface MergeValidatorInterface
{
    /**
     * @return bool
     */
    public function isMerge();
}
