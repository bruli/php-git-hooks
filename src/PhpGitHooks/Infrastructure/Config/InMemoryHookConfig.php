<?php

namespace PhpGitHooks\Infrastructure\Config;

use PhpGitHooks\Application\Config\HookConfigExtraToolInterface;
use PhpGitHooks\Application\Config\HookConfigInterface;
use PhpGitHooks\Application\Message\MessageConfigData;

/**
 * Class InMemoryHookConfig.
 */
class InMemoryHookConfig implements HookConfigInterface, HookConfigExtraToolInterface
{
    /** @var  bool */
    private $enabled;
    /** @var array  */
    private $extraOptions = [];

    private $messages = [
        MessageConfigData::KEY_ERROR_MESSAGE => 'error',
        MessageConfigData::KEY_RIGHT_MESSAGE => 'perfect',
    ];

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

    /**
     * @return array
     */
    public function getMessages()
    {
        return $this->messages;
    }
}
