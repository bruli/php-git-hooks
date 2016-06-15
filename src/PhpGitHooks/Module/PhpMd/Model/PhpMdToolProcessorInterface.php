<?php

namespace PhpGitHooks\Module\PhpMd\Model;

interface PhpMdToolProcessorInterface
{
    /**
     * @param string $file
     *
     * @return string
     */
    public function process($file);
}
