<?php

namespace PhpGitHooks\Infrastructure\Git;

/**
 * Interface MergeValidatorInterface.
 */
interface MergeValidatorInterface
{
    /**
     * @return bool
     */
    public function isMerge();
}
