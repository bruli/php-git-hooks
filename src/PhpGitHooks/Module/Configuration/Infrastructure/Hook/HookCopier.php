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
        return \file_exists($this->hooksDir . "/$hookFile");
    }

    protected function copyFile(string $hookFile): void
    {
        $this->createHooksDir();

        $copy = new Process(['cp', $hookFile, $this->hooksDir]);
        $copy->run();
    }

    protected function createHooksDir(): void
    {
        $mkdir = new Process(['mkdir', '-p', $this->hooksDir]);
        $mkdir->run();
    }

    protected function setPermissions(string $hookFile): void
    {
        $permissions = new Process(['chmod', '775', $this->hooksDir . "/$hookFile"]);
        $permissions->run();
    }

    protected function copyHookFile(string $file): void
    {
        if (false === $this->hookExists($file)) {
            $this->copyFile($this->sourceHooksDir . "/$file");
            $this->setPermissions($file);
        }
    }
}
