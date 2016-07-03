<?php

namespace PhpGitHooks\Module\PhpUnit\Model;

interface StrictCoverageProcessorInterface
{
    /**
     * @return float
     */
    public function process();
}
