<?php

namespace PhpGitHooks\Module\Git\Model;

interface PrePushOriginalExecutorInterface
{
    /**
     * @param string $remote
     * @param string $url
     *
     * @return string|null
     */
    public function execute($remote, $url);
}
