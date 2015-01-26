<?php

namespace PhpGitHooks\Infrastructure\Git;

/**
 * Class MergeValidator
 * @package PhpGitHooks\Infrastructure\Git
 */
class MergeValidator
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
