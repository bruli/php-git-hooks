<?php

namespace PhpGitHooks\Infrastructure\Git;

/**
 * Class InMemoryMergeValidator
 * @package PhpGitHooks\Infrastructure\Git
 */
class InMemoryMergeValidator implements MergeValidatorInterface
{
    /** @var  bool */
    private $merge;

    /**
     * @param boolean $merge
     */
    public function setMerge($merge)
    {
        $this->merge = $merge;
    }

    /**
     * @return bool
     */
    public function isMerge()
    {
        return $this->merge;
    }
}
