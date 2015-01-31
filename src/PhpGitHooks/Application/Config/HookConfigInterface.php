<?php

namespace PhpGitHooks\Application\Config;

/**
 * Interface HookConfigInterface
 * @package PhpGitHooks\Application\Config
 */
interface HookConfigInterface
{
    /**
     * @param  string $hook
     * @return bool
     */
    public function isEnabled($hook);
}
