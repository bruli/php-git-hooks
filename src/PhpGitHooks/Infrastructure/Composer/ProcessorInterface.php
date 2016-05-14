<?php

namespace PhpGitHooks\Infrastructure\Composer;

interface ProcessorInterface
{
    /**
     * @return string
     */
    public function hookName();
}
