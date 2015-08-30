<?php

namespace PhpGitHooks\Application\Config;

interface HookConfigExtraToolInterface
{
    /**
     * @param array $tool
     *
     * @return array
     */
    public function extraOptions($tool);
}
