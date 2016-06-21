<?php

namespace PhpGitHooks\Module\Git\Infrastructure\Git;

use PhpGitHooks\Module\Git\Model\PrePushOriginalExecutorInterface;
use Symfony\Component\Process\Process;

class PrePushOriginalExecutor implements PrePushOriginalExecutorInterface
{
    /**
     * @param string $remote
     * @param string $url
     *
     * @return string|null
     */
    public function execute($remote, $url)
    {
        $process = new Process(sprintf('./%s %s %s', 'pre-push-original', $remote, $url));
        $process->run();
        
        return $process->getOutput();
    }
}
