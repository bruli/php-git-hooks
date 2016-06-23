<?php

namespace PhpGitHooks\Module\Git\Model;

interface MergeValidatorInterface
{
    /**
     * @return bool
     */
    public function isMerge();
}
