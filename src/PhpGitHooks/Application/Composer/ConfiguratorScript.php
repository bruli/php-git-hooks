<?php

namespace PhpGitHooks\Application\Composer;

use Composer\Script\Event;

/**
 * Class ConfiguratorScript.
 *
 * @codingStandardsIgnoreFile
 */
class ConfiguratorScript
{
    public static function buildConfig(Event $event)
    {
        if (true === $event->isDevMode()) {
            $message = "Deprecated instalation script!!\n";
            $message .= "Please replace it by \\PhpGitHooks\\Infrastructure\\Composer\\ConfiguratorScript::buildConfig\nin your composer.json file";
            $event->getIO()->writeError(sprintf('<error>%s</error>', $message));
        }
    }
}
