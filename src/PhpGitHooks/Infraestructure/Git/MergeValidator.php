<?php

namespace PhpGitHooks\Infraestructure\Git;

/**
 * Class MergeValidator
 * @package PhpGitHooks\Infraestructure\Git
 */
class MergeValidator
{
    /**
     * @return bool
     */
    public function isMerge()
    {
        foreach (['MERGE_MSG', 'MERGE_HEAD', 'MERGE_MODE'] as $fileName) {
            if (file_exists('.git/' . $fileName)) {
                return true;
            }
        }

        return false;
    }
}
