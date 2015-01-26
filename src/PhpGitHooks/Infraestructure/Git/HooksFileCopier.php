<?php

namespace PhpGitHooks\Infraestructure\Git;

use Symfony\Component\Process\Process;

/**
 * Class HooksFileCopier
 * @package PhpGitHooks\Infraestructure\Git
 */
class HooksFileCopier
{
    const GIT_HOOKS_PATH = '.git/hooks/';

    /**
     * @param string $hook
     */
    public function copy($hook)
    {
        if (false === file_exists(self::GIT_HOOKS_PATH.$hook)) {
            $copy = new Process('cp '.__DIR__.'/../../../../hooks/'.$hook.' .git/hooks/'.$hook);
            $copy->run();
        }
    }
}
