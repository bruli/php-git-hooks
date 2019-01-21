<?php

namespace PhpGitHooks\Module\Configuration\Infrastructure\Hook;

use Symfony\Component\Process\Process;

class HookCopier
{
    public const DEFAULT_GIT_HOOKS_DIR = '.git/hooks';

    protected $hooksDir       = self::DEFAULT_GIT_HOOKS_DIR;
    protected $sourceHooksDir = __DIR__ . '/../../../../Infrastructure/Hook';

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

    public function copyPrepareCommitMsgHook(): void
    {
        $this->copyHookFile('prepare-commit-msg');
    }

    protected function hookExists(string $hookFile): bool
    {
        return file_exists(sprintf('%s%s', $this->hooksDir, $hookFile));
    }

    protected function copyFile(string $hookFile): void
    {
        $copy = new Process(sprintf("mkdir -p {$this->hooksDir} && cp %s %s", $hookFile, $this->hooksDir));
        $copy->run();
    }

    protected function setPermissions(string $hookFile): void
    {
        $permissions = new Process(sprintf('chmod 775 %s%s', $this->hooksDir, $hookFile));
        $permissions->run();
    }

    protected function copyHookFile(string $file): void
    {
        if (false === $this->hookExists($file)) {
            $this->copyFile(sprintf('%s/%s', $this->sourceHooksDir, $file));
            $this->setPermissions($file);
        }
    }
}
