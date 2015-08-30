<?php

namespace PhpGitHooks\Infrastructure\Git;

use Symfony\Component\Process\Process;

/**
 * Class HooksFileCopier.
 */
class HooksFileCopier
{
    const GIT_HOOKS_PATH = '.git/hooks/';

    /**
     * @param string $hook
     * @param bool   $enabled
     */
    public function copy($hook, $enabled)
    {
        if (true === $enabled) {
            if (false === file_exists(self::GIT_HOOKS_PATH.$hook)) {
                $copy = new Process('cp '.__DIR__.'/../../../../hooks/'.$hook.' .git/hooks/'.$hook);
                $copy->run();
            }
        }
    }
}
