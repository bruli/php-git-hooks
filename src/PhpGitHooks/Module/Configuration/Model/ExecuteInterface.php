<?php

namespace PhpGitHooks\Module\Configuration\Model;

interface ExecuteInterface
{
    /**
     * @return ToolInterface[]
     */
    public function execute();
}
