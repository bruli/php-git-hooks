<?php

namespace PhpGitHooks\Application\Config;

/**
 * Interface HookConfigInterface.
 */
interface HookConfigInterface
{
    /**
     * @param string $hook
     *
     * @return bool
     */
    public function isEnabled($hook);
}
