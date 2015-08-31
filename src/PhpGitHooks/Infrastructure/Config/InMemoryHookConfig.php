<?php

namespace PhpGitHooks\Infrastructure\Config;

use PhpGitHooks\Application\Config\HookConfigExtraToolInterface;
use PhpGitHooks\Application\Config\HookConfigInterface;

/**
 * Class InMemoryHookConfig.
 */
class InMemoryHookConfig implements HookConfigInterface, HookConfigExtraToolInterface
{
    /** @var  bool */
    private $enabled;
    /** @var array  */
    private $extraOptions = [];

    /**
     * @param bool $enabled
     */
    public function setEnabled($enabled)
    {
        $this->enabled = $enabled;
    }

    /**
     * @param string $hook
     *
     * @return bool
     */
    public function isEnabled($hook)
    {
        return $this->enabled;
    }

    /**
     * @param array $extraOptions
     */
    public function setExtraOptions($extraOptions)
    {
        $this->extraOptions = $extraOptions;
    }

    /**
     * @param array $tool
     *
     * @return array
     */
    public function extraOptions($tool)
    {
        return $this->extraOptions;
    }
}
