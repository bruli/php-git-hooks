<?php

namespace PhpGitHooks\Module\Configuration\Model;

interface ToolInterface
{
    /**
     * @return bool
     */
    public function isEnabled();

    /**
     * @return bool
     */
    public function isUndefined();
}
