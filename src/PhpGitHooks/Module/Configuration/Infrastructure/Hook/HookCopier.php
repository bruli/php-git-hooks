<?php

namespace PhpGitHooks\Module\Configuration\Infrastructure\Hook;

use Symfony\Component\Process\Process;

class HookCopier
{
    private $hookDir = '.git/hooks/';

    public function copyPreCommitHook()
    {
        $file = 'pre-commit';
        if (false === $this->hookExists($file)) {
            $this->copyFile(sprintf('%s/%s', __DIR__.'/../../../../Infrastructure/Hook', $file));
            $this->setPermissions($file);
        }
    }

    public function copyCommitMsgHook()
    {
        $file = 'commit-msg';

        if (false === $this->hookExists($file)) {
            $this->copyFile(sprintf('%s/%s', __DIR__.'/../../../../Infrastructure/Hook', $file));
            $this->setPermissions($file);
        }
    }

    /**
     * @param string $hookFile
     *
     * @return bool
     */
    private function hookExists($hookFile)
    {
        return file_exists(sprintf('%s%s', $this->hookDir, $hookFile));
    }

    /**
     * @param string $hookFile
     */
    private function copyFile($hookFile)
    {
        $copy = new Process(sprintf('cp %s %s', $hookFile, $this->hookDir));
        $copy->run();
    }

    /**
     * @param $hookFile
     */
    private function setPermissions($hookFile)
    {
        $permissions = new Process(sprintf('chmod 775 %s%s', $this->hookDir, $hookFile));
        $permissions->run();
    }
}
