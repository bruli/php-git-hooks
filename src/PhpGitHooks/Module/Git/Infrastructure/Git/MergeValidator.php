<?php

namespace PhpGitHooks\Module\Git\Infrastructure\Git;

use PhpGitHooks\Module\Git\Model\MergeValidatorInterface;

class MergeValidator implements MergeValidatorInterface
{
    /**
     * @return bool
     */
    public function isMerge()
    {
        foreach (array('MERGE_MSG', 'MERGE_HEAD', 'MERGE_MODE') as $fileName) {
            if (file_exists('.git/'.$fileName)) {
                return true;
            }
        }

        return false;
    }
}
