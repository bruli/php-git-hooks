<?php

namespace PhpGitHooks\Composer;

use Composer\Script\Event;
use Composer\IO;

/**
 * Class ConfiguratorScript
 * @package PhpGitHooks\Composer
 */
class ConfiguratorScript
{
    /**
     * @param Event $event
     */
    public static function buildConfig(Event $event)
    {
        if (false
            === $event->isDevMode()) {
            return;
        }

        $processor = new ConfiguratorProcessor($event->getIO());

        return $processor->process();
    }
}