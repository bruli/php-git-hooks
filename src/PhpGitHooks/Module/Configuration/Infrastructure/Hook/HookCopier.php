<?php

namespace PhpGitHooks\Module\Configuration\Infrastructure\Hook;

use Symfony\Component\Process\Process;

class HookCopier
{
    private $hookDir = '.git/hooks/';

    public function copyPreCommitHook(): void
    {
        $this->copyHookFile('pre-commit');
    }

    public function copyCommitMsgHook(): void
    {
        $this->copyHookFile('commit-msg');
    }

    public function copyPrePushHook(): void
    {
        $this->copyHookFile('pre-push');
    }

    private function hookExists(string $hookFile): bool
    {
        return file_exists(sprintf('%s%s', $this->hookDir, $hookFile));
    }

    private function copyFile(string $hookFile): void
    {
        $copy = new Process(sprintf("mkdir -p {$this->hookDir} && cp %s %s", $hookFile, $this->hookDir));
        $copy->run();
    }

    private function setPermissions(string $hookFile): void
    {
        $permissions = new Process(sprintf('chmod 775 %s%s', $this->hookDir, $hookFile));
        $permissions->run();
    }

    private function copyHookFile(string $file): void
    {
        if (false === $this->hookExists($file)) {
            $this->copyFile(sprintf('%s/%s', __DIR__ . '/../../../../Infrastructure/Hook', $file));
            $this->setPermissions($file);
        }
    }
}
