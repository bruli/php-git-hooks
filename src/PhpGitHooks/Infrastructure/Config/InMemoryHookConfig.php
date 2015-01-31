<?php

namespace PhpGitHooks\Infrastructure\Config;

use PhpGitHooks\Application\Config\HookConfigInterface;

/**
 * Class InMemoryHookConfig
 * @package PhpGitHooks\Infrastructrure\Config
 */
class InMemoryHookConfig implements HookConfigInterface
{
    /** @var  bool */
    private $enabled;

    /**
     * @param bool $enabled
     */
    public function setEnabled($enabled)
    {
        $this->enabled = $enabled;
    }

    /**
     * @param  string $hook
     * @return bool
     */
    public function isEnabled($hook)
    {
        return $this->enabled;
    }
}
