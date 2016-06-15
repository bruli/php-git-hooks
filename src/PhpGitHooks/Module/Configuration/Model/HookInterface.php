<?php

namespace PhpGitHooks\Module\Configuration\Model;

interface HookInterface
{
    /**
     * @return bool
     */
    public function isEnabled();

    /**
     * @return bool
     */
    public function isUndefined();

    /**
     * @return ExecuteInterface
     */
    public function getExecute();
}
